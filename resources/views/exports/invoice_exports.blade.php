<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ url('/assets/img/icons/icon-48x48.png') }}" />
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/assets/css/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/assets/css/toastr.min.css') }}"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Invoice PDF</title>

	<link href="{{ url('/assets/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<style>
table, th, td {
  border: 1px solid black;
}
</style>

<body>
    <main class="content">
        <form action={{ route('products.invoice.payment') }} method="POST">
        @csrf
	    <div class="container-fluid p-0">
            <div class='card'>
  
                <div class='card-body'>
                <div>
                    <h3 class='text-success' style="color: #1CBB8C; font-family: sans-serif"><b>Koperasi Kosgoro</b></h3>
                </div>
                <div class='row mt-3'>
                    <div class='col'>
                        <p><b style="font-family: sans-serif">Pembeli</b> {{ $products[0]->users->fullname }}<br>
                            <b style="font-family: sans-serif">Nomor Invoice</b> {{ $invoice->nomor_invoice }}<br>
                            <b style="font-family: sans-serif">Tanggal</b> {{ $invoice->tanggal_pembayaran }}
                        </p>
                    </div>

                    <input type="hidden" name="id" value="{{ $invoice->id }}">

                    <div class='col text-right'>
                        <p style="font-family: sans-serif"><b>Metode Pembayaran : </b>
                            @if( $type == 'payment' )
                                <select name='payment'>
                                    <option class='text-success'>Cash<span class='fas fa-dollar-sign'></span></option>
                                    <option class='text-warning'>Potong Gaji</option>
                                </select>
                            @else
                                <b style="color: #1CBB8C">{{ $invoice->payment }}</b>
                            @endif
                        </p>
                    </div>
                </div>

                <table class='table' style="width: 100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Type</th>
                            <th>Rack</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $products as $data )
                            <tr class='text-dark'>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->rack->name }}</td>
                                <td>Rp.{{ $data->sell_price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>Rp.{{ $data->sell_price * $data->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h3 class='text-success' style="color: #1CBB8C; font-family: sans-serif"><b>Subtotal</b> : (Rp.{{ $invoice->total }}) </h3>
                </div>
            </div>
        </div>
        </form>
    </main>
</body>


