@extends('layouts.app')

@section('content')

<div class="card card-stat card-blue mb-4">
    <div class="card-body">

    <div class="d-flex justify-content-between align-items-start">

        <div>

            <h3>

                <i class="bi bi-laptop me-2"></i>

                Data Laptop

            </h3>

            <p class="mb-0">

                Kelola data laptop yang tersedia untuk disewakan.

            </p>

            <div class="row mt-4 g-3">

            <div class="col-md-4">

                <div class="mini-card">

                    <h2>{{ $totalLaptop }}</h2>

                    <p>Total Laptop</p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="mini-card">

                    <h2>{{ $tersedia }}</h2>

                    <p>Tersedia</p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="mini-card">

                    <h2>{{ $dirental }}</h2>

                    <p>Sedang Dirental</p>

                </div>

            </div>

        </div>
        </div>


        <a href="{{ route('laptops.create') }}"
           class="btn btn-light">

            <i class="bi bi-plus-circle"></i>

            Tambah Laptop

        </a>

    </div>

</div>
</div>


<div class="table-box">

    <form method="GET"
          action="{{ route('laptops.index') }}"
          class="mb-3">

        <div class="row">

            <div class="col-md-4">
                <input type="text"
                       name="keyword"
                       class="form-control"
                       placeholder="Cari merk atau model..."
                       value="{{ $keyword ?? '' }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">
                    Cari
                </button>
            </div>

        </div>

    </form>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <table class="table table-blue align-middle">

        <thead>
            <tr>
                <th>Merk</th>
                <th>Model</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach($laptops as $laptop)

            <tr>

                <td>{{ $laptop->merk }}</td>

                <td>{{ $laptop->model }}</td>

                <td>
                    Rp {{ number_format($laptop->harga_harian,0,',','.') }}
                </td>

                <td>

                    @if(in_array(strtolower($laptop->status), ['tersedia','available']))

                        <span class="badge bg-success">
                            Tersedia
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Dirental
                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('laptops.edit',$laptop->id) }}"
                       class="btn btn-warning btn-sm">

                        <i class="bi bi-pencil"></i>

                    </a>


                    <form action="{{ route('laptops.destroy',$laptop->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus laptop ini?')">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    <div class="pagination-blue mt-3">
        {{ $laptops->links() }}
    </div>

</div>

@endsection