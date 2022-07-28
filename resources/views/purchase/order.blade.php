@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Purchase</strong> Order</h1>
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
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $purchase_order as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->supplyer }}</td>
                                    <td>{{ $data->total_price }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="{{ route('purchase.order.delete', $data->id) }}" class='btn btn-danger btn-sm'>Delete</a>
                                        <a href="{{ route('purchase.order.approve', $data->id) }}" class='btn btn-success btn-sm'>Approve</a>
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
            $('#data').DataTable();
        });
    </script>
@endsection
