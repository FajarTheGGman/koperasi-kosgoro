@extends('.template.app')

@section('content')
	<main class="content">
        <form action={{ route('products.invoice.payment') }} method="POST">
        @csrf
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
                            <b>Nomor Invoice</b> &nbsp&nbsp&nbsp&nbsp {{ $invoice->nomor_invoice }}<br>
                            <b>Tanggal</b> &nbsp&nbsp&nbsp&nbsp {{ $invoice->tanggal_pembayaran }}
                        </p>
                    </div>

                    <input type="hidden" name="id" value="{{ $invoice->id }}">

                    <div class='col text-right'>
                        <p><b>Metode Pembayaran : </b>
                            @if( $type == 'payment' )
                                <select name='payment'>
                                    <option class='text-success'>Cash<span class='fas fa-dollar-sign'></span></option>
                                    <option class='text-warning'>Potong Gaji</option>
                                </select>
                            @else
                                @if( $invoice->status_pembayaran == 'Pending' )
                                    <select name='payment'>
                                        <option class='text-success'>Cash<span class='fas fa-dollar-sign'></span></option>
                                        <option class='text-warning'>Potong Gaji</option>
                                    </select>
                                @else
                                    <b class='text text-success'>{{ $invoice->payment }}</b>
                                @endif
                            @endif
                        </p>
                    </div>
                </div>

                <table class='table' id="data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Type</th>
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
                                <td>{{ $data->type }}</td>
                                <td>Rp.{{ $data->sell_price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>Rp.{{ $data->sell_price * $data->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h5 class='text-success'><b>Subtotal</b> : (Rp.{{ $invoice->total }})  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>
                </div>
                @if( $type == 'payment' )
                    <button class='btn btn-success'><b>Selesaikan Pembayaran</b></button>
                @elseif( $type == 'view' )
                    @if( $invoice->status_pembayaran == 'Pending' )
                        <button class='btn btn-success'><b>Selesaikan Pembayaran</b></button>
                    @else
                        <a href="{{ route('purchase.laporan.invoice') }}" class='btn btn-success'><i data-feather='arrow-left'></i> Kembali</a>
                        <button type="button" class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#pdf" ><i data-feather='file-text'></i> Export PDF</button>
                    @endif
                @endif
            </div>
        </div>
        </form>
        <div class='modal fade-up' id='pdf' tabindex='-1' role='dialog' aria-labelledby='modal-delete-label' aria-hidden='true'>
            <div class='modal-dialog modal-xl' role='document'>
                <div class='modal-content'>
                    <div class='modal-header bg-success'>
                        <h3 class='modal-title' id='modal-delete-label'>Invoice PDF</h3>
                    </div>
                    <div class='modal-body'>
                        <iframe src="{{ route('products.invoice.export', $invoice->id) }}" width="100%" height="430px" frameborder="0"></iframe>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                    </div>
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
        });
    </script>
@endsection
