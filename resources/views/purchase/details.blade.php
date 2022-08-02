@extends('.template.app')

@section('content')
	<main class="content">
        <form action={{ route('products.invoice.payment') }} method="POST">
        @csrf
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Purchase</strong> Details</h1>
            <a href="{{ route('purchase.order') }}" class="btn btn-sm btn-primary"><i data-feather="arrow-left"></i> Back</a>
            <div class='card mt-3'>
  
                <div class='card-body'>
                <div>
                    <h3 class='text-success'><b>Koperasi Kosgoro</b></h3>
                </div>
                <div class='row mt-3'>
                    <div class='col'>
                        <p><b>Nomor Purchase Request</b> &nbsp&nbsp&nbsp&nbsp <br>
                            <b>Tanggal</b> &nbsp&nbsp&nbsp&nbsp {{ $laporan_pr->created_at }} <br>
                            <b>Status</b> &nbsp&nbsp&nbsp&nbsp 
                            @if( $laporan_pr->status == 'Process' )
                                <b class='text text-warning'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Declined' )
                                <b class='text text-danger'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Approved' )
                                <b class='text text-success'>{{ $po->status }}</b>
                            @endif
                                <br>
                        </p>
                    </div>

                </div>

                <table class='table'>
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
                    <h5 class='text-success'><b>Subtotal</b> : (Rp.{{ $laporan_pr->total_price }})  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>
                        <a class='btn btn-success btn-sm' href={{ route('purchase.order.approve', $po->id) }}><i data-feather='check'></i> Approve</a>
                        <a href="{{ route('purchase.order.decline', ['id' => $po->id, 'pr_id' => $po->pr_id]) }}" class='btn btn-danger btn-sm'><i data-feather='trash'></i> Decline</a>
                </div>
            </div>
        </div>
        </form>
    </main>
@endsection
