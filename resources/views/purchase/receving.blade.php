@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Receving</strong> Order</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Supplyer</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Purchase Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $purchase_order as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->supplyer }}</td>
                                    <td>Rp.{{ $data->total_price }}</td>
                                    <td>
                                        @if( $data->status == 'Process' || $data->status == 'Receiving')
                                            <b class='text text-warning'>{{ $data->status }}</b>
                                        @elseif( $data->status == 'Declined' )
                                            <b class='text text-danger'>{{ $data->status }}</b>
                                        @elseif( $data->status == 'Approved' )
                                            <b class='text text-success'>{{ $data->status }}</b>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $data->created_at }}
                                    </td>
                                    <td>
                                        <a href="{{ route('purchase.order.details', ['id' => $data->id, 'pr_id' => $data->pr_id]) }}" class='btn btn-primary btn-sm'><i data-feather='eye'></i> Details</a>
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
            })
        })
    </script>
@endsection
