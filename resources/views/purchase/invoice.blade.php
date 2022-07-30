@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Invoice</strong> Products</h1>
            <div class='card'>
  
                <div class='card-body'>
                <div>
                    <h3 class='text-success'><b>Koperasi Kosgoro</b></h3>
                </div>
                <div class='row mt-3'>
                    <div class='col'>
                        <p><b>Pembeli</b> &nbsp&nbsp&nbsp&nbsp {{ $products[0]->users->fullname }}<br>
                            <b>Nomor Invoice</b> &nbsp&nbsp&nbsp&nbsp {{ $invoice[0]->nomor_invoice }}<br>
                            <b>Tanggal</b> &nbsp&nbsp&nbsp&nbsp {{ $invoice[0]->tanggal_pembelian }}
                        </p>
                    </div>

                    <div class='col text-right'>
                        <p><b>Metode Pembayaran : </b>
                            <select>
                                <option class='text-success'>Cash<span class='fas fa-dollar-sign'></span></option>
                                <option class='text-warning'>Potong Gaji</option>
                            </select>
                        </p>
                    </div>
                </div>

                <table class='table'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach( $products as $data )
                            <tr class='text-dark'>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->sell_price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->sell_price * $data->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h5 class='text-success'><b>Subtotal</b> : (Rp.{{ $invoice[0]->total }})  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>
                </div>
                <button class='btn btn-success'><b>Selesaikan Pembayaran</b></button>
            </div>
        </div>
    </main>
@endsection
