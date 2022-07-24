@extends('.template.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item">Purchase</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('purchase.request') }}">Request</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class='card'>
            <div class='card-header'>
                  <div class='row'>
                      <div class='col-sm-6'>
                          <h2 class="card-title"><b>List Purchase Order</b></h2>
                      </div>
                      <div class='col-sm-6 text-right'>
                          <a href={{ route('purchase.request.order') }} class="btn btn-success">Membayar Tagihan</a>
                      </div>
                  </div>
            </div>
            <div class='card-body'>
                <table class='table table-dark'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Supplyer</th>
                            <th>Sell Price</th>
                            <th>Status</th>
                            <th>Rak</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $purchase_order as $product )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>Rp.{{ $product->price }}</td>
                                <td>{{ $product->type }}</td>
                                <td>
                                    <a href="{{ asset('image/'.$product->image) }}">
                                        <img src="{{ asset('image/'.$product->image) }}" width="100px" height="100px">
                                    </a>
                                </td>
                                <td>{{ $product->nama }}</td>
                                <td>Rp.{{ $product->sell_price }}</td>
                                @if($product->status == 'Pending')
                                    <td class='text-warning'><b>{{ $product->status }}</b></td>
                                @else
                                    <td class='text-success'><b>{{ $product->status }}</b></td>
                                @endif
                                <td>{{ $product->rak }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection
