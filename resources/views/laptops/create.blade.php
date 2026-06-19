@extends('layouts.app')

@section('content')

<div class="card card-stat card-blue mb-4">
    <div class="card-body">

        <h3>Tambah Laptop</h3>

        <p>Tambahkan data laptop baru ke dalam sistem.</p>

    </div>
</div>


<div class="table-box">

<form action="{{ route('laptops.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label class="form-label">
            Merk
        </label>

        <input type="text"
                name="merk"
                class="form-control"
                value="{{ old('merk') }}">

        @error('merk')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Model
        </label>

        <input type="text"
                name="model"
                class="form-control"
                value="{{ old('model') }}">

        @error('model')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Spesifikasi
        </label>

        <textarea name="spesifikasi"
          class="form-control">{{ old('spesifikasi') }}</textarea>

        @error('spesifikasi')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    <div class="mb-4">

        <label class="form-label">
            Harga Harian
        </label>

        <input type="number"
                name="harga_harian"
                class="form-control"
                value="{{ old('harga_harian') }}">

        @error('harga_harian')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    <button type="submit"
            class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>


    <a href="{{ route('laptops.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</form>

</div>

@endsection