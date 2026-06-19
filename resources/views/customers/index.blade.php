@extends('layouts.app')

@section('content')

<div class="card card-stat card-green mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">

            <div>

                <h3>

                    <i class="bi bi-people me-2"></i>

                    Data Pelanggan

                </h3>

                <p class="mb-0">

                    Kelola data pelanggan rental laptop.

                </p>

            </div>


            <a href="{{ route('customers.create') }}"
               class="btn btn-light">

                <i class="bi bi-plus-circle me-1"></i>

                Tambah Pelanggan

            </a>

        </div>


        <div class="row mt-4 g-3">

            <div class="col-md-2 col-sm-4">

                <div class="mini-card">

                    <h2>{{ $totalCustomer }}</h2>

                    <p>Total Pelanggan</p>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="table-box">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <table class="table table-green align-middle">

        <thead>

            <tr>

                <th>Nama</th>

                <th>Alamat</th>

                <th>Telepon</th>

                <th>Email</th>

                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

        @foreach($customers as $customer)

            <tr>

                <td>{{ $customer->nama }}</td>

                <td>{{ $customer->alamat }}</td>

                <td>{{ $customer->telepon }}</td>

                <td>{{ $customer->email }}</td>

                <td>

                    <a href="{{ route('customers.edit',$customer->id) }}"
                       class="btn btn-warning btn-sm rounded-pill">

                        <i class="bi bi-pencil"></i>

                    </a>


                    <form action="{{ route('customers.destroy',$customer->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm rounded-pill"
                                onclick="return confirm('Yakin ingin menghapus customer ini?')">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    <div class="pagination-green mt-3">
        {{ $customers->links() }}
    </div>

</div>

@endsection