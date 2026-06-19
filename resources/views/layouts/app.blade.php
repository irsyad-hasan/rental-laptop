<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rental Laptop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Hilangkan panah pada input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number]{
            -moz-appearance: textfield;
        }

        body{
            background:#f4f6fb;
        }

        /* Header */
        .header{
            background:linear-gradient(90deg,#6f42c1,#0d6efd);
            color:white;
            padding:25px;
            border-radius:0 0 20px 20px;
        }

        /* Menu */
        .nav-menu{
            background:white;
            padding:15px;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        .nav-menu a{
            text-decoration:none;
            color:#333;
            font-weight:600;
            margin-right:15px;
            padding:12px 18px;
            border-radius:12px;
            transition:0.3s;
        }

        .nav-menu a:hover{
            background:#f4f6fb;
            color:#0d6efd;
        }

        /* Card */
        .card-stat{
            border:none;
            border-radius:20px;
            color:white;
        }

        .card-blue{
            background:#2196f3;
        }

        .card-green{
            background:#4caf50;
        }

        .card-orange{
            background:#ff9800;
        }

        .card-purple{
            background:#9c27b0;
        }

        /* Tabel */
        .table-box{
            background:white;
            padding:20px;
            border-radius:20px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }
        
        .table{
            overflow:hidden;
            border-radius:15px;
        }

        .table thead{
            background:#f8fafc;
        }

        .table thead th{
            border:none;
            color:#64748b;
            font-size:14px;
            font-weight:600;
            padding:16px;
        }

        .table tbody td{
            vertical-align:middle;
            padding:18px 16px;
        }

        .table tbody tr{
            border-bottom:1px solid #f1f5f9;
        }

        .table tbody tr:hover{
            background:#f8fafc;
        }

        /* Mini Card Statistik */
        .mini-card{
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            backdrop-filter: blur(8px);

            padding: 15px;
            height: 100px;
            border-radius: 18px;

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;

            text-align: center;

            color: white;

            box-shadow: 0 4px 15px rgba(0,0,0,.15);
        }

        .mini-card h2{
            margin-bottom: 5px;
            font-weight: bold;
        }

        .mini-card p{
            margin-bottom: 0;
            font-size: 14px;
        }

        .mini-card-small{
            background:rgba(255,255,255,.15);
            border:1px solid rgba(255,255,255,.25);
            backdrop-filter:blur(8px);

            padding:15px;

            height:100px;

            border-radius:18px;

            display:flex;
            flex-direction:column;

            justify-content:center;
            align-items:center;

            color:white;

            box-shadow:0 4px 15px rgba(0,0,0,.15);
        }

        .mini-card-small h2{
            margin-bottom:5px;
            font-weight:bold;
        }

        .mini-card-small p{
            margin-bottom:0;
            font-size:14px;
        }
        
        /* Card statistik laporan */
        .report-card{
            border:none;
            border-radius:25px;
            color:white;
            box-shadow:0 5px 20px rgba(0,0,0,.15);
        }

        .report-blue{
            background:linear-gradient(135deg,#3b82f6,#06b6d4);
        }

        .report-green{
            background:linear-gradient(135deg,#059669,#14b8a6);
        }

        .report-orange{
            background:linear-gradient(135deg,#f97316,#f59e0b);
        }

        .report-purple{
            background:linear-gradient(135deg,#7c3aed,#9333ea);
        }

        .report-icon{
            width:60px;
            height:60px;
            background:rgba(255,255,255,.15);
            border-radius:20px;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:30px;
        }

        /* ===== HEADER TABEL ===== */
        .table-blue thead{
            background:#2196f3;
            color:white;
        }

        .table-green thead{
            background:#4caf50;
            color:white;
        }

        .table-orange thead{
            background:#ff9800;
            color:white;
        }

        .table-purple thead{
            background:#9c27b0;
            color:white;
        }

        .table thead th{
            border:none;
        }

        .table tbody tr:hover{
            background:#f8f9fa;
        }


        /* ===== PAGINATION ===== */

        /* Laptop */
        .pagination-blue .page-item.active .page-link{
            background:#2196f3 !important;
            border-color:#2196f3 !important;
            color:white !important;
        }

        .pagination-blue .page-link{
            color:#2196f3 !important;
        }


        /* Pelanggan */
        .pagination-green .page-item.active .page-link{
            background:#4caf50 !important;
            border-color:#4caf50 !important;
            color:white !important;
        }

        .pagination-green .page-link{
            color:#4caf50 !important;
        }


        /* Rental */
        .pagination-orange .page-item.active .page-link{
            background:#ff9800 !important;
            border-color:#ff9800 !important;
            color:white !important;
        }

        .pagination-orange .page-link{
            color:#ff9800 !important;
        }


        /* Laporan */
        .pagination-purple .page-item.active .page-link{
            background:#9c27b0 !important;
            border-color:#9c27b0 !important;
            color:white !important;
        }

        .pagination-purple .page-link{
            color:#9c27b0 !important;
        }

    </style>

</head>
    <body>

<div class="header">

    <div class="d-flex align-items-center">

        <!-- Tombol Home -->
        <a href="{{ url('/') }}"
           class="text-white me-3"
           style="
                font-size:40px;
                text-decoration:none;
           ">

            <i class="bi bi-laptop"></i>

        </a>


        <!-- Judul -->
        <div>

            <h2 class="mb-1">

                Rental Management System

            </h2>

            <p class="mb-0">

                Sistem Informasi Rental Laptop

            </p>

        </div>

    </div>

</div>

<div class="container mt-4">

    <div class="nav-menu mb-4">

    <a href="{{ route('laptops.index') }}">

        <i class="bi bi-laptop me-2"></i>

        Data Laptop

    </a>


    <a href="{{ route('customers.index') }}">

        <i class="bi bi-people-fill me-2"></i>

        Data Pelanggan

    </a>


    <a href="{{ route('rentals.index') }}">

        <i class="bi bi-arrow-left-right me-2"></i>

        Transaksi Rental

    </a>


    <a href="{{ route('laporan') }}">

        <i class="bi bi-file-earmark-text-fill me-2"></i>

        Laporan Rental

    </a>

</div>

    @yield('content')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>