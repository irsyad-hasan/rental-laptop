<!DOCTYPE html>

<html>
<head>


<title>Laporan Rental Laptop</title>

<style>

    body{
        font-family: Arial, sans-serif;
        font-size:14px;
    }

    h1{
        text-align:center;
        margin-bottom:5px;
    }

    .subjudul{
        text-align:center;
        margin-bottom:20px;
    }

    .tanggal{
        margin-bottom:20px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th{
        background:#eeeeee;
    }

    table, th, td{
        border:1px solid black;
    }

    th, td{
        padding:8px;
        text-align:center;
    }

    .total{
        margin-top:20px;
        text-align:right;
    }

</style>


</head>
<body>

<h1>
    LAPORAN RENTAL LAPTOP
</h1>

<div class="subjudul">


Sistem Informasi Rental Laptop


</div>

<div class="tanggal">


Tanggal Cetak :
{{ date('d-m-Y') }}


</div>

<table>

<thead>

<tr>


<th>No</th>

<th>Customer</th>

<th>Laptop</th>

<th>Tanggal Rental</th>

<th>Total Biaya</th>

<th>Status</th>


</tr>

</thead>

<tbody>

@foreach($rentals as $rental)

<tr>


<td>

    {{ $loop->iteration }}

</td>


<td>

    {{ $rental->customer->nama }}

</td>


<td>

    {{ $rental->laptop->merk }}
    {{ $rental->laptop->model }}

</td>


<td>

    {{ $rental->tanggal_rental }}

</td>


<td>

    Rp {{ number_format($rental->total_biaya,0,',','.') }}

</td>


<td>

    {{ ucfirst($rental->status) }}

</td>


</tr>

@endforeach

</tbody>

</table>

<div class="total">


<h3>

    Total Pendapatan :

    Rp {{ number_format($totalPendapatan,0,',','.') }}

</h3>


</div>

<br><br><br>

<div style="text-align:right">


Mengetahui,

<br><br><br><br>

____________________


</div>

</body>
</html>
