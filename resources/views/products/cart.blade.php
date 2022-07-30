@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Products</strong> Cart</h1>
            <div class='card'>
                <div class='card-body'>
                    <form action={{ route('products.invoice') }} method="POST">
                    @csrf
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $products as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" name="name[]" value="{{ $data->name }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="type[]" value="{{ $data->type }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <img src="{{ url('image/'.$data->image) }}" alt="{{ $data->name }}" width="150px" height="100px"> 
                                    </td>
                                    <td>
                                        <input type="text" name="barcode[]" value="{{ $data->barcode }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="price[]" value="{{ $data->price }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control" value="1" min="1" max={{ \App\Models\ProductsPurchase::where('name', $data->name)->first()->quantity }}>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.cart.delete', $data->id) }}" class='btn btn-danger btn-sm'><i data-feather='minus-circle'></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success"><i data-feather="shopping-cart"></i> Checkout</button>
                    </form>
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
