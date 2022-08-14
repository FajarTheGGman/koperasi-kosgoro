@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Laporan</strong> Laba</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table' id="data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pembeli</th>
                                <th>Nomor Invoice</th>
                                <th>Status Pembayaran</th>
                                <th>Payment Type</th>
                                <th>Total Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $invoice as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->users->fullname }}</td>
                                    <td>{{ $data->nomor_invoice }}</td>
                                    <td>
                                        @if( $data->status_pembayaran == 'Paid' )
                                            <span class="badge bg-success badge-md">Paid</span>
                                        @else
                                            <span class='badge bg-danger'>{{ $data->status_pembayaran }}</span>
                                        @endif
                                    </td>
                                    <td><b class='text text-warning'>{{ $data->payment }}</b></td>
                                    <td>
                                        <b class='text text-danger'>Rp.{{ $data->total }}</b>
                                    </td>
                                    <td>{{ $data->tanggal_pembayaran }}</td>
                                    <td>
                                        <a href="{{ route('products.invoice.detail', $data->id) }}" class='btn btn-sm btn-primary btn-sm'><span data-feather="eye"></span> Details</a>
                                        <a href="{{ route('products.invoice.delete', $data->id) }}" class='btn btn-danger btn-sm ml-4 mt-2'><span data-feather='trash'></span> Delete</span>
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
            $("#data").DataTable({
                responsive: true
            });
        });
    </script>
@endsection
