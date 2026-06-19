@extends('layouts.app')

@section('content')

<div class="card card-stat card-orange mb-4">
    <div class="card-body">

        <h3>Rental Baru</h3>

        <p>Buat transaksi penyewaan laptop baru.</p>

    </div>
</div>


<div class="table-box">

<form action="{{ route('rentals.store') }}" method="POST">

    @csrf


    <div class="mb-3">

        <label class="form-label">
            Customer
        </label>

        <select name="customer_id"
                class="form-control"
                required>

            <option value="">
                Pilih Customer
            </option>

            @foreach($customers as $customer)

                <option value="{{ $customer->id }}">
                    {{ $customer->nama }}
                </option>

            @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Laptop
        </label>

        <select name="laptop_id"
                class="form-control"
                required>

            <option value="">
                Pilih Laptop
            </option>

            @foreach($laptops as $laptop)

                <option value="{{ $laptop->id }}">

                    {{ $laptop->merk }}
                    {{ $laptop->model }}

                    - Rp {{ number_format($laptop->harga_harian,0,',','.') }}/hari

                </option>

            @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Tanggal Rental
        </label>

        <input type="date"
               name="tanggal_rental"
               class="form-control"
               required>

    </div>


    <div class="mb-4">

        <label class="form-label">
            Durasi (Hari)
        </label>

        <input type="number"
               name="durasi"
               class="form-control"
               required>

    </div>


    <button type="submit"
            class="btn btn-warning text-white">

        <i class="bi bi-save"></i>

        Simpan Rental

    </button>


    <a href="{{ route('rentals.index') }}"
       class="btn btn-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</form>

</div>

@endsection