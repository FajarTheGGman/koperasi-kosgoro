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
              <li class="breadcrumb-item active"><a href="{{ route('purchase.invoice') }}">Invoice</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class='card'>
            <div class='card-header'>
                <h4><b>Invoice Products</b></h4>
            </div>

            <div class='card-body'>
                <div>
                    <h3 class='text-success'><b>Koperasi Kosgoro</b></h3>
                </div>
                <div class='row mt-3'>
                    <div class='col'>
                        <p><b>Pembeli</b> &nbsp&nbsp&nbsp&nbsp testing<br>
                           <b>Nomor Invoice</b> &nbsp&nbsp&nbsp&nbsp 123123<br>
                           <b>Tanggal</b> &nbsp&nbsp&nbsp&nbsp 12-12-12
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
                        <tr class='text-dark'>
                            <td>1</td>
                            <td>Koperasi Kosgoro</td>
                            <td>Rp. 1.000.000</td>
                            <td>1</td>
                            <td>Rp. 1.000.000</td>
                        </tr>
                        <tr class='bg-gray'>
                            <td>2</td>
                            <td>Koperasi Kosgoro</td>
                            <td>Rp. 1.000.000</td>
                            <td>1</td>
                            <td>Rp. 1.000.000</td>
                        </tr>
                    </tbody>
                </table>
                <div class='col mt-2 text-right'>
                    <h5 class='text-success'><b>Subtotal</b> : (Rp. 123) &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h5>
                </div>
                <button class='btn btn-success'><b>Selesaikan Pembayaran</b></button>
            </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection
