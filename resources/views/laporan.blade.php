@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="card card-stat card-purple mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">

            <div>

                <h3>

                    <i class="bi bi-file-earmark-text me-2"></i>

                    Laporan Rental

                </h3>

                <p class="mb-0">

                    Analisis dan ringkasan transaksi rental.

                </p>

            </div>


            <a href="{{ route('laporan.pdf',[
                'tanggal_awal'=>request('tanggal_awal'),
                'tanggal_akhir'=>request('tanggal_akhir')
            ]) }}"
               class="btn btn-light">

                <i class="bi bi-file-earmark-pdf me-1"></i>

                Export PDF

            </a>

        </div>

    </div>

</div>



<!-- Statistik -->
<div class="row mb-4">

    <!-- Total Rental -->
    <div class="col-md-3 mb-3">

        <div class="card report-card report-blue">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Rental</h6>

                        <h1>

                            {{ $rentals->count() }}

                        </h1>

                        <small>transaksi</small>

                    </div>

                    <div class="report-icon">

                        <i class="bi bi-arrow-up-right"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Pendapatan -->
    <div class="col-md-3 mb-3">

        <div class="card report-card report-green h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Pendapatan</h6>

                        <h3>

                            Rp {{ number_format($totalPendapatan,0,',','.') }}

                        </h3>

                    </div>

                    <div class="report-icon">

                        <i class="bi bi-cash"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Rental Aktif -->
    <div class="col-md-3 mb-3">

        <div class="card report-card report-orange">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Rental Aktif</h6>

                        <h1>

                            {{ $rentals->where('status','aktif')->count() }}

                        </h1>

                        <small>sedang berjalan</small>

                    </div>

                    <div class="report-icon">

                        <i class="bi bi-clock"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Rental Selesai -->
    <div class="col-md-3 mb-3">

        <div class="card report-card report-purple">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Rental Selesai</h6>

                        <h1>

                            {{ $rentals->where('status','selesai')->count() }}

                        </h1>

                        <small>selesai</small>

                    </div>

                    <div class="report-icon">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- Filter -->
<div class="table-box mb-4">

    <h4 class="mb-4">

        <i class="bi bi-funnel me-2"></i>

        Filter Laporan

    </h4>


    <form method="GET"
          action="{{ url('/laporan') }}">

        <div class="row">

            <div class="col-md-4">

                <label class="mb-2">

                    Tanggal Mulai

                </label>

                <input type="date"
                       name="tanggal_awal"
                       class="form-control"
                       value="{{ request('tanggal_awal') }}">

            </div>



            <div class="col-md-4">

                <label class="mb-2">

                    Tanggal Akhir

                </label>

                <input type="date"
                       name="tanggal_akhir"
                       class="form-control"
                       value="{{ request('tanggal_akhir') }}">

            </div>



            <div class="col-md-4 d-flex align-items-end">

                <button class="btn btn-primary rounded-pill me-2">

                    <i class="bi bi-search me-1"></i>

                    Filter

                </button>


                <a href="{{ url('/laporan') }}"
                   class="btn btn-outline-secondary rounded-pill">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>



<!-- Detail Transaksi -->
<div class="table-box">

    <h4 class="mb-4">

        <i class="bi bi-table me-2"></i>

        Detail Transaksi

    </h4>


    <table class="table table-purple table-hover align-middle">

        <thead>

        <tr>

            <th>ID</th>

            <th>Tanggal</th>

            <th>Laptop</th>

            <th>Pelanggan</th>

            <th>Durasi</th>

            <th>Biaya Rental</th>

            <th>Denda</th>

            <th>Total</th>

            <th>Status</th>

        </tr>

        </thead>


        <tbody>

        @foreach($rentals as $rental)

        <tr>

            <td>

                <strong>

                    #{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}

                </strong>

            </td>

            <td>

                {{ $rental->tanggal_rental }}

            </td>

            <td>

                {{ $rental->laptop->merk }}

                {{ $rental->laptop->model }}

            </td>

            <td>

                {{ $rental->customer->nama }}

            </td>

            <td>

                <span
                class="badge rounded-pill px-3 py-2"
                style="
                background:#e0f2fe;
                color:#0284c7;
                font-size:13px;
                ">

                    {{ $rental->durasi }} Hari

                </span>

            </td>

            <td class="text-success">

                Rp {{ number_format($rental->total_biaya,0,',','.') }}

            </td>

            <td>

                Rp {{ number_format($rental->denda,0,',','.') }}

                </td>


                <td>

                <strong>

                Rp {{ number_format(
                $rental->total_biaya + $rental->denda,
                0,
                ',',
                '.'
                ) }}

                </strong>

                </td>

            <td>

                @if($rental->status=='aktif')

                    <span class="badge rounded-pill px-3 py-2"
                        style="
                            background:#fff3cd;
                            color:#ff9800;
                            font-size:13px;
                        ">

                        ● Aktif

                    </span>

                @else

                    <span class="badge rounded-pill px-3 py-2"
                        style="
                            background:#d1fae5;
                            color:#059669;
                            font-size:13px;
                        ">

                        ● Selesai

                    </span>

                @endif

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>


    <hr>


    <div class="row justify-content-end">

        <div class="col-md-4">


            <div class="d-flex justify-content-between mb-3">

                <h4>

                    Subtotal :

                </h4>

                <h4>

                    Rp {{ number_format($subtotal,0,',','.') }}

                </h4>

            </div>


            <div class="d-flex justify-content-between mb-3">

                <h4 class="text-secondary">

                    Total Denda :

                </h4>

                <h4 class="text-danger">

                    Rp {{ number_format($totalDenda,0,',','.') }}

                </h4>

            </div>


            <hr>


            <div
                class="rounded-4 p-4"
                style="
                background:linear-gradient(135deg,#16a34a,#22c55e);
                color:white;
                box-shadow:0 8px 20px rgba(34,197,94,.3);
                ">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5>

                            Total Pendapatan

                        </h5>

                        <small>

                            Seluruh transaksi

                        </small>

                    </div>

                    <h3>

                        Rp {{ number_format($totalPendapatan,0,',','.') }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection