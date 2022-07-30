@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Laporan</strong> Transaksi</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-responsive-sm' id="data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Invoice</th>
                                <th>Status Pembayaran</th>
                                <th>Payment Type</th>
                                <th>Total Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $invoice as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nomor_invoice }}</td>
                                    <td>{{ $data->status_pembayaran }}</td>
                                    <td>{{ $data->payment }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->tanggal_pembayaran }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success"><i data-feather=""></i>Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#data").DataTable();
        })
    </script>
@endsection

