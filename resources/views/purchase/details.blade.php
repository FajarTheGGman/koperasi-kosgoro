@extends('.template.app')

@section('content')
	<main class="content">
        <form action={{ route('purchase.receiving.approve', ['id' => $po->id, 'pr_id' => $laporan_pr->id]) }} method="POST">
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
                        <p><b>Nomor Purchase Request</b> &nbsp&nbsp&nbsp {{ $laporan_pr->nomor_pr }}<br>
                            <b>Tanggal</b> &nbsp&nbsp&nbsp&nbsp {{ $laporan_pr->created_at }} <br>
                            <b>Status</b> &nbsp&nbsp&nbsp&nbsp 
                            @if( $laporan_pr->status == 'Process' )
                                <b class='text text-warning'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Declined' )
                                <b class='text text-danger'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Receiving' )
                                <b class='text text-warning'>{{ $laporan_pr->status }} </b>
                            @elseif( $laporan_pr->status == 'Approved' )
                                <b class='text text-success'>{{ $po->status }}</b>
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

                <table class='table' id="data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            @if( $laporan_pr->status != 'Approved' )
                                <th>Action</th>
                            @endif
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
                                @if( $laporan_pr->status != 'Approved' )
                                    <th>
                                        <a href="{{ route('purchase.order.products.delete', ['id' => $data->id, 'pr_id' => $data->pr_id]) }}" class="btn btn-sm btn-danger"><i data-feather="minus-circle"></i></a>
                                    </th>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h5 class='text-success'><b>Subtotal</b> : (Rp.{{ $laporan_pr->total_price }})  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>
                    @if( $users->roles->name == 'Admin' )
                        @if( $laporan_pr->status == 'Approved' )
                        @else
                            <button type='submit' class='btn btn-success btn-sm'><i data-feather='check'></i> Approve</button>
                        @endif
                    @else
                        @if( $laporan_pr->status == 'Receiving' )
                            <a class='btn btn-secondary btn-sm'> <i data-feather='check'></i> Waiting Approval</a>
                        @elseif( $laporan_pr->status == 'Approved' )
                            <a class='btn btn-secondary btn-sm'> <i data-feather='check'></i> Approved</a>
                        @else
                            <a class='btn btn-success btn-sm' href={{ route('purchase.order.approve', $po->id) }}><i data-feather='check'></i> Continue To Admin</a>
                        @endif
                    @endif
                        @if( $laporan_pr->status != 'Receiving' && $users->roles->name != 'Admin' )
                            @if( $laporan_pr->status != 'Approved' )
                                <a href="{{ route('purchase.order.decline', ['id' => $po->id, 'pr_id' => $po->pr_id]) }}" class='btn btn-warning btn-sm'><i data-feather='minus-circle'></i> Decline</a>
                                <a href="{{ route('purchase.order.delete', $po->id) }}" class='btn btn-danger btn-sm'><i data-feather='trash-2'></i> Delete</a>
                            @endif
                        @elseif( $users->roles->name == 'Admin' )
                            @if( $laporan_pr->status != 'Approved' )
                                <a href="{{ route('purchase.order.decline', ['id' => $po->id, 'pr_id' => $po->pr_id]) }}" class='btn btn-warning btn-sm'><i data-feather='minus-circle'></i> Decline</a>
                            @endif
                            <a href="{{ route('purchase.order.delete', $po->id) }}" class='btn btn-danger btn-sm'><i data-feather='trash-2'></i> Delete</a>
                            @if( $laporan_pr->status == 'Approved' )
                                <button type="button" data-bs-toggle="modal" data-bs-target="#pdf" class="btn btn-primary btn-sm"><i data-feather='file-text'></i> PDF</button>
                            @endif
                        @endif
                </div>
            </div>
        </div>
        <div class='modal fade-up' id='pdf' tabindex='-1' role='dialog' aria-labelledby='modal-delete-label' aria-hidden='true'>
            <div class='modal-dialog modal-xl' role='document'>
                <div class='modal-content'>
                    <div class='modal-header bg-success'>
                        <h3 class='modal-title' id='modal-delete-label'>Purchase PDF</h3>
                    </div>
                    <div class='modal-body'>
                        <iframe src="{{ route('purchase.order.exports', ['id' => $po->id, 'pr_id' => $laporan_pr->id]) }}" width="100%" height="430px" frameborder="0"></iframe>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </main>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#data').DataTable({
            responsive: true
        });
    });
</script>
@endsection
