@extends('layouts.app')

@section('content')

<div class="card card-stat card-orange mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">

            <div>

                <h3>

                    <i class="bi bi-arrow-left-right me-2"></i>

                    Transaksi Rental

                </h3>

                <p class="mb-0">

                    Kelola transaksi penyewaan laptop.

                </p>

            </div>


            <a href="{{ route('rentals.create') }}"
               class="btn btn-light">

                <i class="bi bi-plus-circle me-1"></i>

                Rental Baru

            </a>

        </div>


        <div class="row mt-4 g-3">

            <div class="col-md-2">

                <div class="mini-card-small">

                    <h2>{{ $rentalAktif }}</h2>

                    <p>Rental Aktif</p>

                </div>

            </div>


            <div class="col-md-2">

                <div class="mini-card-small">

                    <h2>{{ $rentalSelesai }}</h2>

                    <p>Rental Selesai</p>

                </div>

            </div>


            <div class="col-md-2">

                <div class="mini-card-small">

                    <h2>{{ $laptopTersedia }}</h2>

                    <p>Laptop Tersedia</p>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="mb-4">

    <button
        id="btnAktif"
        class="btn btn-warning rounded-pill shadow-sm"
        onclick="showAktif()">

        Rental Aktif ({{ $rentalAktif }})

    </button>

    <button
        id="btnRiwayat"
        class="btn btn-light rounded-pill shadow-sm"
        onclick="showRiwayat()">

        Riwayat ({{ $rentalSelesai }})

    </button>

</div>

<div class="table-box">

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div id="aktifTable">

<table class="table table-orange align-middle">

    <thead>
    <tr>
        <th>Laptop</th>
        <th>Pelanggan</th>
        <th>Tgl Rental</th>
        <th>Tgl Kembali</th>
        <th>Durasi</th>
        <th>Total Biaya</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>

    @forelse($rentals as $rental)

    <tr>

        <td>
            {{ $rental->laptop->merk }}
            {{ $rental->laptop->model }}
        </td>

        <td>
            {{ $rental->customer->nama }}
        </td>

        <td>
            {{ $rental->tanggal_rental }}
        </td>

        <td>
            {{ $rental->tanggal_kembali }}
        </td>

        <td>
            {{ $rental->durasi }} Hari
        </td>

        <td>
            Rp {{ number_format($rental->total_biaya,0,',','.') }}
        </td>

        <td>
            <span class="badge bg-success">
                Aktif
            </span>
        </td>

        <td>

            <button
                class="btn btn-success btn-sm rounded-pill openReturnModal"
                data-id="{{ $rental->id }}">

                <i class="bi bi-check-circle me-1"></i>
                Kembalikan

            </button>

        </td>

    </tr>

    @empty

    <tr>

        <td colspan="8"
            class="text-center text-muted">

            Tidak ada rental aktif

        </td>

    </tr>

    @endforelse

    </tbody>

</table>

</div>

<div id="riwayatTable" style="display:none;">

<table class="table align-middle">

    <thead>

    <tr>

        <th>Laptop</th>
        <th>Pelanggan</th>
        <th>Tgl Rental</th>
        <th>Tgl Kembali</th>
        <th>Durasi</th>
        <th>Total Biaya</th>
        <th>Denda</th>
        <th>Status</th>

    </tr>

    </thead>

    <tbody>

    @forelse($riwayatRentals as $rental)

    <tr>

        <td>

            {{ $rental->laptop->merk }}
            {{ $rental->laptop->model }}

        </td>

        <td>

            {{ $rental->customer->nama }}

        </td>

        <td>

            {{ $rental->tanggal_rental }}

        </td>

        <td>

            {{ $rental->tanggal_kembali }}

        </td>

        <td>

            {{ $rental->durasi }} Hari

        </td>

        <td>

            Rp {{ number_format($rental->total_biaya,0,',','.') }}

        </td>

        <td>

            Rp {{ number_format($rental->denda,0,',','.') }}

        </td>

        <td>

            <span class="badge bg-secondary">

                Selesai

            </span>

        </td>

    </tr>

    @empty

    <tr>

        <td colspan="8"
            class="text-center text-muted">

            Belum ada riwayat rental

        </td>

    </tr>

    @endforelse

    </tbody>

</table>

</div>

</div>
<!-- Modal Pengembalian -->
<div class="modal fade"
     id="returnModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="returnForm"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h4 class="text-warning">

                        Pengembalian Laptop

                    </h4>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    <label class="mb-2">

                        Denda (jika ada)

                    </label>

                    <input type="number"
                           name="denda"
                           value="0"
                           class="form-control">

                    <small class="text-muted">

                        Masukkan jumlah denda jika laptop terlambat
                        atau mengalami kerusakan.

                    </small>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-warning">

                        Proses Pengembalian

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

document.querySelectorAll('.openReturnModal')
.forEach(button => {

    button.addEventListener('click', function(){

        let id = this.dataset.id;

        document.getElementById('returnForm').action =
            "/rentals/" + id + "/return";

        let modal = new bootstrap.Modal(
            document.getElementById('returnModal')
        );

        modal.show();

    });

});

</script>
<script>

function showAktif() {

    document.getElementById('aktifTable').style.display = 'block';
    document.getElementById('riwayatTable').style.display = 'none';

    // warna tombol
    document.getElementById('btnAktif')
        .className = 'btn btn-warning rounded-pill shadow-sm';

    document.getElementById('btnRiwayat')
        .className = 'btn btn-light rounded-pill shadow-sm';

}

function showRiwayat() {

    document.getElementById('aktifTable').style.display = 'none';
    document.getElementById('riwayatTable').style.display = 'block';

    // warna tombol
    document.getElementById('btnAktif')
        .className = 'btn btn-light rounded-pill shadow-sm';

    document.getElementById('btnRiwayat')
        .className = 'btn btn-secondary rounded-pill shadow-sm';

}

</script>
@endsection