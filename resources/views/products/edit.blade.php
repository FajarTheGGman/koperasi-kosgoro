@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Products</strong> {{ $products->name }}</h1>
            <a href="{{ route('products.index') }}" class='btn btn-primary btn-sm'><i data-feather='arrow-left'></i> Back</a>
            <div class='card mt-2'>
                <div class='card-body'>
                    <form action={{ route('products.update') }} method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $products->name }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" value="{{ $products->price }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="sell_price">Sell Price</label>
                            <input type="text" class="form-control" name="sell_price" id="sell_price" value="{{ $products->sell_price }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="type">Type</label>
                                <select class='form-control' id='type' name='type'>
                                    @foreach( $enum_type as $type )
                                        <option value='{{ $type->value }}'>{{ $type->value }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image</label>
                            <img src="{{ url('image/'.$products->image) }}" alt="{{ $products->name }}" width="150px" height="100px">
                        </div>
                        <div class="form-group mt-2">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $products->quantity }}">
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
