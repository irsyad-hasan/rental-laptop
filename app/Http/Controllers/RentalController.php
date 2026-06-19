<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Laptop;
use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RentalController extends Controller
{
    public function index()
    {
        $rentalAktif = Rental::where('status', 'aktif')->count();

        $rentalSelesai = Rental::where('status', 'selesai')->count();

        $laptopTersedia = Laptop::where('status', 'tersedia')->count();


        // Data rental aktif
        $rentals = Rental::with([
            'customer',
            'laptop'
        ])
            ->where('status', 'aktif')
            ->orderBy('id', 'asc')
            ->get();


        // Data riwayat rental
        $riwayatRentals = Rental::with([
            'customer',
            'laptop'
        ])
            ->where('status', 'selesai')
            ->orderBy('id', 'asc')
            ->get();


        return view(
            'rentals.index',
            compact(
                'rentals',
                'riwayatRentals',
                'rentalAktif',
                'rentalSelesai',
                'laptopTersedia'
            )
        );
    }
    public function dashboard()
    {
        $totalLaptop = Laptop::count();

        $totalCustomer = Customer::count();

        $rentalAktif = Rental::where('status', 'aktif')->count();

        $rentalSelesai = Rental::where('status', 'selesai')->count();

        $totalPendapatan = Rental::sum('total_biaya');

        $recentRentals = Rental::with([
            'customer',
            'laptop'
        ])
            ->latest()
            ->take(5)
            ->get();

        return view(
            'dashboard',
            compact(
                'totalLaptop',
                'totalCustomer',
                'rentalAktif',
                'rentalSelesai',
                'totalPendapatan',
                'recentRentals'
            )
        );
    }

    public function pelanggan()
    {
        return view('pelanggan');
    }

    public function transaksi()
    {
        return view('transaksi');
    }

    public function laporan(Request $request)
    {
        $query = Rental::with([
            'customer',
            'laptop'
        ]);

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween(
                'tanggal_rental',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );
        }

        $rentals = $query
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        $subtotal = $rentals->sum('total_biaya');

        $totalDenda = $rentals->sum('denda');

        $totalPendapatan = $subtotal + $totalDenda;

        return view(
            'laporan',
            compact(
                'rentals',
                'subtotal',
                'totalDenda',
                'totalPendapatan'
            )
        );
    }
    public function create()
    {
        $customers = Customer::all();

        $laptops = Laptop::where('status', 'tersedia')->get();

        return view('rentals.create', compact(
            'customers',
            'laptops'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'laptop_id' => 'required',
            'tanggal_rental' => 'required|date',
            'durasi' => 'required|numeric|min:1',
        ]);

        $laptop = Laptop::findOrFail($request->laptop_id);

        $tanggalKembali = date(
            'Y-m-d',
            strtotime($request->tanggal_rental . ' + ' . $request->durasi . ' days')
        );

        $totalBiaya = $laptop->harga_harian * $request->durasi;

        Rental::create([
            'customer_id' => $request->customer_id,
            'laptop_id' => $request->laptop_id,
            'tanggal_rental' => $request->tanggal_rental,
            'tanggal_kembali' => $tanggalKembali,
            'durasi' => $request->durasi,
            'total_biaya' => $totalBiaya,
            'status' => 'aktif'
        ]);

        $laptop->update([
            'status' => 'dirental'
        ]);

        return redirect()
            ->route('rentals.index')
            ->with('success', 'Rental berhasil dibuat');
    }
    public function returnLaptop(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status' => 'selesai',
            'denda' => $request->denda ?? 0
        ]);

        $rental->laptop->update([
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('rentals.index')
            ->with(
                'success',
                'Laptop berhasil dikembalikan'
            );
    }
    public function exportPdf(Request $request)
    {
        $query = Rental::with([
            'customer',
            'laptop'
        ]);

        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $query->whereBetween(
                'tanggal_rental',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );
        }

        $rentals = $query->latest()->get();

        $totalPendapatan = $rentals->sum(function ($rental) {

            return $rental->total_biaya + $rental->denda;

        });

        $pdf = Pdf::loadView(
            'laporan_pdf',
            compact(
                'rentals',
                'totalPendapatan'
            )
        );

        return $pdf->download(
            'laporan-rental-laptop.pdf'
        );
    }
}