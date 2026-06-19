<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $laptops = Laptop::when($keyword, function ($query) use ($keyword) {
            $query->where('merk', 'like', "%$keyword%")
                ->orWhere('model', 'like', "%$keyword%");
        })
            ->paginate(10)
            ->withQueryString();

        $totalLaptop = Laptop::count();

        $tersedia = Laptop::where('status', 'tersedia')->count();

        $dirental = Laptop::where('status', 'dirental')->count();

        return view(
            'laptops.index',
            compact(
                'laptops',
                'keyword',
                'totalLaptop',
                'tersedia',
                'dirental'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laptops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'merk' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/',
                    'max:50'
                ],

                'model' => 'required|max:100',

                'spesifikasi' => 'required|max:500',

                'harga_harian' => 'required|numeric|gt:0',
            ],
            [
                'merk.required' => 'Merk wajib diisi.',
                'merk.regex' => 'Merk hanya boleh berisi huruf.',

                'model.required' => 'Model wajib diisi.',

                'spesifikasi.required' => 'Spesifikasi wajib diisi.',

                'harga_harian.required' => 'Harga harian wajib diisi.',
                'harga_harian.numeric' => 'Harga harian harus berupa angka.',
                'harga_harian.gt' => 'Harga harian harus lebih besar dari 0.',
            ]
        );

        Laptop::create([
            'merk' => $request->merk,
            'model' => $request->model,
            'spesifikasi' => $request->spesifikasi,
            'harga_harian' => $request->harga_harian,
            'status' => 'tersedia'
        ]);

        return redirect()
            ->route('laptops.index')
            ->with('success', 'Laptop berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laptop = Laptop::findOrFail($id);

        return view('laptops.edit', compact('laptop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'merk' => [
                    'required',
                    'regex:/^[A-Za-z\s]+$/',
                    'max:50'
                ],

                'model' => 'required|max:100',

                'spesifikasi' => 'required|max:500',

                'harga_harian' => 'required|numeric|gt:0',
            ],
            [
                'merk.regex' =>
                    'Merk hanya boleh berisi huruf.',

                'harga_harian.gt' =>
                    'Harga sewa harus lebih besar dari 0.'
            ]
        );

        $laptop = Laptop::findOrFail($id);

        $laptop->update([
            'merk' => $request->merk,
            'model' => $request->model,
            'spesifikasi' => $request->spesifikasi,
            'harga_harian' => $request->harga_harian,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('laptops.index')
            ->with('success', 'Laptop berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laptop = Laptop::findOrFail($id);

        if ($laptop->status == 'dirental') {
            return redirect()
                ->route('laptops.index')
                ->with('error', 'Laptop sedang dirental dan tidak dapat dihapus');
        }

        $laptop->delete();

        return redirect()
            ->route('laptops.index')
            ->with('success', 'Laptop berhasil dihapus');
    }
}
