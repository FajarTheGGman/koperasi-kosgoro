@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Products</strong> Store</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $products as $data )
                                @if( $data->quantity != 0 )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->sell_price }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>
                                            <img src="{{ url('image/'.$data->image) }}" alt="{{ $data->name }}" width="150px" height="100px">
                                        </td>
                                        <td>
                                            @if(\App\Models\Cart::where('name', $data->name)->first())
                                                <a href="{{ route('products.cart') }}" class='btn btn-secondary btn-sm'>Added</a>
                                            @else
                                                <a href="{{ route('products.cart.add', $data->id) }}" class='btn btn-primary btn-sm'>Add to Cart</a>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->sell_price }}</td>
                                        <td>{{ $data->type }}</td>
                                        <td>
                                            <img src="{{ url('image/'.$data->image) }}" alt="{{ $data->name }}" width="150px" height="100px">
                                        </td>
                                        <td>
                                            <a href="#" class='btn btn-danger btn-sm' disabled>Out of Stock</a>
                                        </td>
                                    </tr>
                                @endif
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
            $("#data").DataTable()
        })
    </script>
@endsection

