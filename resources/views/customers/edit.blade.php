@extends('layouts.app')

@section('content')

<div class="card card-stat card-green mb-4">
    <div class="card-body">

        <h3>Edit Customer</h3>

        <p>Perbarui informasi customer yang sudah terdaftar.</p>

    </div>
</div>


<div class="table-box">

<form action="{{ route('customers.update', $customer->id) }}"
      method="POST">

    @csrf
    @method('PUT')


    <div class="mb-3">

        <label class="form-label">
            Nama
        </label>

        <input type="text"
               name="nama"
               class="form-control"
               value="{{ $customer->nama }}"
               required>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Alamat
        </label>

        <textarea name="alamat"
                  class="form-control"
                  rows="3">{{ $customer->alamat }}</textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Telepon
        </label>

        <input type="text"
               name="telepon"
               class="form-control"
               value="{{ $customer->telepon }}"
               required>

    </div>


    <div class="mb-4">

        <label class="form-label">
            Email
        </label>

        <input type="email"
               name="email"
               class="form-control"
               value="{{ $customer->email }}">

    </div>


    <button type="submit"
            class="btn btn-success">

        <i class="bi bi-save"></i>

        Update

    </button>


    <a href="{{ route('customers.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</form>

</div>

@endsection