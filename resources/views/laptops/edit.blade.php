@extends('layouts.app')

@section('content')

<div class="card card-stat card-blue mb-4">
    <div class="card-body">

        <h3>Edit Laptop</h3>

        <p>Perbarui informasi laptop yang tersedia di sistem.</p>

    </div>
</div>


<div class="table-box">

<form action="{{ route('laptops.update', $laptop->id) }}"
      method="POST">

    @csrf
    @method('PUT')


    <div class="mb-3">

        <label class="form-label">
            Merk
        </label>

        <input type="text"
               name="merk"
               class="form-control"
               value="{{ $laptop->merk }}"
               required>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Model
        </label>

        <input type="text"
               name="model"
               class="form-control"
               value="{{ $laptop->model }}"
               required>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Spesifikasi
        </label>

        <textarea name="spesifikasi"
                  class="form-control"
                  rows="4">{{ $laptop->spesifikasi }}</textarea>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Harga Harian
        </label>

        <input type="number"
               name="harga_harian"
               class="form-control"
               value="{{ $laptop->harga_harian }}"
               required>

    </div>


    <div class="mb-4">

        <label class="form-label">
            Status
        </label>

        <select name="status"
                class="form-control">

            <option value="tersedia"
                {{ $laptop->status == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>

            <option value="dirental"
                {{ $laptop->status == 'dirental' ? 'selected' : '' }}>
                Dirental
            </option>

        </select>

    </div>


    <button type="submit"
            class="btn btn-primary">

        <i class="bi bi-save"></i>

        Update

    </button>


    <a href="{{ route('laptops.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</form>

</div>

@endsection