@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2>

        <i class="bi bi-speedometer2 me-2"></i>

        Dashboard Rental Laptop

    </h2>

    <p class="text-muted">

        Ringkasan data sistem rental laptop.

    </p>

</div>


<div class="row">

    <!-- Total Laptop -->
    <div class="col-md-3 mb-4">

        <div class="card card-stat card-blue shadow">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Laptop</h6>

                        <h2>

                            {{ $totalLaptop }}

                        </h2>

                    </div>

                    <i class="bi bi-laptop fs-1"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- Total Customer -->
    <div class="col-md-3 mb-4">

        <div class="card card-stat card-green shadow">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Total Customer</h6>

                        <h2>

                            {{ $totalCustomer }}

                        </h2>

                    </div>

                    <i class="bi bi-people fs-1"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- Rental Aktif -->
    <div class="col-md-3 mb-4">

        <div class="card card-stat card-orange shadow">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Rental Aktif</h6>

                        <h2>

                            {{ $rentalAktif }}

                        </h2>

                    </div>

                    <i class="bi bi-arrow-left-right fs-1"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- Rental Selesai -->
    <div class="col-md-3 mb-4">

        <div class="card card-stat card-purple shadow">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <h6>Rental Selesai</h6>

                        <h2>

                            {{ $rentalSelesai }}

                        </h2>

                    </div>

                    <i class="bi bi-check-circle fs-1"></i>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="row">

    <!-- Pendapatan -->
    <div class="col-md-4">

        <div class="table-box">

            <h4 class="mb-3">

                <i class="bi bi-cash-stack me-2"></i>

                Total Pendapatan

            </h4>

            <h2 class="text-success">

                Rp {{ number_format($totalPendapatan,0,',','.') }}

            </h2>

        </div>

    </div>



    <!-- Transaksi Terbaru -->
    <div class="col-md-8">

        <div class="table-box">

            <h4 class="mb-3">

                <i class="bi bi-clock-history me-2"></i>

                Transaksi Terbaru

            </h4>


            <table class="table align-middle">

                <thead>

                <tr>

                    <th>Customer</th>

                    <th>Laptop</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                @foreach($recentRentals as $rental)

                <tr>

                    <td>

                        {{ $rental->customer->nama }}

                    </td>

                    <td>

                        {{ $rental->laptop->merk }}

                        {{ $rental->laptop->model }}

                    </td>

                    <td>

                        @if($rental->status=='aktif')

                            <span class="badge bg-warning">

                                Aktif

                            </span>

                        @else

                            <span class="badge bg-success">

                                Selesai

                            </span>

                        @endif

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection