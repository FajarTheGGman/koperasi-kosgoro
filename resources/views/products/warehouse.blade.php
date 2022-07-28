@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Warehouse</strong> Products</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Sell Price</th>
                                <th>Rak</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $products as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->image }}</td>
                                    <td>{{ $data->barcode }}</td>
                                    <td>{{ $data->sell_price }}</td>
                                    <td>{{ $data->rack->name }}</td>
                                    <td>
                                        <b class='text text-success'>{{ $data->status }}</b>
                                    <td>
                                        <a href="{{ route('products.warehouse.delete', $data->id) }}" class='btn btn-danger btn-sm'>Delete</a>
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
