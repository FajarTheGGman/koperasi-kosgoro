@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Purchase</strong> Request</h1>
            <div class='card'>
                <div class='card-header'>
                    <button type='button' data-bs-toggle='modal' data-bs-target='#add' class='btn btn-primary'><i data-feather='plus'></i> Add Request</button>
                </div>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Supplyer</th>
                                <th>Rack</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $purchase_request as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->supplyer }}</td>
                                    <td>{{ $data->rack->name }}</td>
                                    <td>Rp.{{ $data->total_price }}</td>
                                    <td>
                                        @if( $data->status == 'Process' )
                                            <b class='text text-warning'>{{ $data->status }}</b>
                                        @else
                                            <b class='text text-success'>{{ $data->status }}</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('purchase.request.delete', $data->id) }}" class='btn btn-danger btn-sm'>Delete</a>
                                        <a href="{{ route('purchase.request.order', $data->rack_id) }}" class='btn btn-success btn-sm'>Checkout</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class='modal fade' id='add' tabindex='-1' role='dialog' aria-labelledby='addLabel' aria-hidden='true'>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('purchase.request.add') }}" method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addLabel">Add New Request</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name='name' class="form-control" id="name" placeholder="Name">
                            </div>

                            <div class="form-group mt-3">
                                <label for="supplyer">Supplyer</label>
                                <select name='supplyer' class="form-control" id="supplyer">
                                    @foreach( $supplyer as $data )
                                        <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="rack">Rack</label>
                                <select name='rack_id' class="form-control" id="rack">
                                    @foreach( $rack as $data )
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h4 class='mt-4'><b>Data Products</b></h4>
                            <table class='table table-stripped' id='product'>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $products as $data )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <input type='number' name='quantity[]' class='form-control' value='1'>
                                            </td>
                                            <td>Rp.{{ $data->price }}</td>
                                            <td>
                                                <input type='hidden' name='product_id[]' value='{{ $data->id }}'>
                                                <input type="checkbox" name='product[]' value='{{ $loop->index }}'>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                responsive: true
            });
            $('#product').DataTable({
            });
        });
    </script>
@endsection
