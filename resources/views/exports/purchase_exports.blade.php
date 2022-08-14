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
        <form action={{ route('purchase.receiving.approve', $po->id) }} method="POST">
        @csrf
	    <div class="container-fluid p-0">
            <div class='card mt-3'>
                <div class='card-body'>
                <div>
                    <h2 class='text-success' style="color: #1CBB8C; font-family: sans-serif"><b>Koperasi Kosgoro</b></h2>
                </div>
                <div class='row mt-3'>
                    <div class='col'>
                        <p style="font-family: sans-serif"><b>Nomor Purchase Request : </b> {{ $laporan_pr->nomor_pr }} <br>
                            <b>Tanggal : </b> {{ $laporan_pr->created_at }} <br>
                            <b>Status : </b>
                            @if( $laporan_pr->status == 'Process' )
                                <b class='text text-warning' style="color: #fcb92c">{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Declined' )
                                <b class='text text-danger'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Receiving' )
                                <b class='text text-warning' style="color: #fcb92c">{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Approved' )
                                <b class='text text-success' style="color: #1CBB8C">{{ $po->status }}</b>
                            @endif
                                <br>
                        </p>
                    </div>

                    @if( $users->roles->name == 'Admin' )
                        @if( $laporan_pr->status != 'Approved' )
                            <div class='col text-right'>
                                <p><b>Expired Date : </b>
                                    <input type="date" name="expired_date" />
                                </p>
                            </div>
                        @endif
                    @endif

                </div>

                <table class='table' id="data" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $products as $data )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>Rp.{{ $data->price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>Rp.{{ $data->price * $data->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h3 class='text-success' style="color: #1CBB8C; font-family: sans-serif;"><b>Subtotal</b> : (Rp.{{ $laporan_pr->total_price }})</h3>
                </div>
            </div>
        </div>
        </form>
        <div style="float: right">
            <h4 style="font-family: sans-serif">Bogor, {{ Date('d M Y') }}</h3>
            <br>
            <br>
            <br>
            <center>
                <h4>Ttd. {{ $users->roles->name }} Koperasi</h4>
            </center>
        </div>
    </main>
</body>
</html>
