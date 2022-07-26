@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Products</strong> </h1>
            <div class='card'>
                <div class='card-header'>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#add" class='btn btn-primary btn-sm'><i data-feather="plus"></i> Add New</button>
                </div>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Sell Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $products as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>Rp.{{ $data->price }}</td>
                                    <td>{{ $data->type }}</td>
                                    <td>
                                        @if( $data->image == 'default.png' )
                                            <img src="{{ url('image/'.$data->image) }}" alt="{{ $data->name }}" width="150px" height="100px">
                                        @else
                                            <img src="{{ url('image/'.$data->image) }}" alt="{{ $data->name }}" width="150px" height="150px">
                                        @endif
                                    </td>
                                    <td>
                                        {!! DNS2D::getBarcodeHTML("Tidak ada informasi", 'QRCODE', 4,4) !!}
                                    </td>
                                    <td>Rp.{{ $data->sell_price }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $data->id) }}" class='btn btn-primary btn-sm'><i data-feather="edit"></i> Edit</a>
                                        <a href="{{ route('products.delete', $data->id) }}" class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal add product -->
        <div class='modal fade' id='add' tabindex='-1' role='dialog' aria-labelledby='addLabel' aria-hidden='true'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('products.create') }}" method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLabel">Add New Product</h5>
                        </div>
                        <div class="modal-body">
                                <div class='form-group'>
                                    <label for="name">Name</label>
                                    <input class='form-control' id='name' name='name' placeholder="Name"/>
                                </div>
                                <div class='form-group mt-4'>
                                    <label for="price">Price</label>
                                    <input type="number" class='form-control' id='price' name='price' placeholder="Price"/>
                                </div>
                                <div class='form-group mt-4'>
                                    <label for="type">Type</label>
                                    <select class='form-control' id='type' name='type'>
                                        @foreach( $enum_type as $type )
                                            <option value='{{ $type->value }}'>{{ $type->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='form-group mt-4'>
                                    <label for="image">Image</label>
                                    <input type='file' class='form-control' id='image' name='image'/>
                                </div>
                                <div class='form-group mt-4'>
                                    <label for=" type=" number"expired">Expired Date</label>
                                    <input type='date' class='form-control' id='expired' name='expired' placeholder="Expired Date"/>
                                </div>
                                <div class='form-group mt-4'>
                                    <label for="sell_price">Sell Price</label>
                                    <input type="number" class='form-control' id='sell_price' name='sell_price' placeholder="Sell Price"/>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            <div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
