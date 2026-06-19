<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);

        $totalCustomer = Customer::count();

        return view(
            'customers.index',
            compact(
                'customers',
                'totalCustomer'
            )
        );
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        Customer::create($request->all());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diupdate');
    }
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus');
    }
}