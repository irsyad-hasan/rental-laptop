@extends('layouts.app')

@section('content')

<div class="card card-stat card-green mb-4">
    <div class="card-body">

        <h3>Tambah Customer</h3>

        <p>Tambahkan data customer baru ke dalam sistem.</p>

    </div>
</div>


<div class="table-box">

<form action="{{ route('customers.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label class="form-label">
            Nama
        </label>

        <input type="text"
               name="nama"
               class="form-control"
               required>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Alamat
        </label>

        <textarea name="alamat"
                  class="form-control"
                  rows="3"></textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Telepon
        </label>

        <input type="text"
               name="telepon"
               class="form-control"
               required>

    </div>


    <div class="mb-4">

        <label class="form-label">
            Email
        </label>

        <input type="email"
               name="email"
               class="form-control">

    </div>


    <button type="submit"
            class="btn btn-success">

        <i class="bi bi-save"></i>

        Simpan

    </button>


    <a href="{{ route('customers.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</form>

</div>

@endsection