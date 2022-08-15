<html>
<head>
    <title>Test</title>
</head>
<body>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pembeli</th>
                                <th>Nomor Invoice</th>
                                <th>Status Pembayaran</th>
                                <th>Payment Type</th>
                                <th>Modal Barang</th>
                                <th>Total Transaksi</th>
                                <th>Total Income</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $invoice as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->users->fullname }}</td>
                                    <td>{{ $data->nomor_invoice }}</td>
                                    <td>
                                        @if( $data->status_pembayaran == 'Paid' )
                                            <span class="badge bg-success badge-md">Paid</span>
                                        @else
                                            <span class='badge bg-danger'>{{ $data->status_pembayaran }}</span>
                                        @endif
                                    </td>
                                    <td><b class='text text-primary'>{{ $data->payment }}</b></td>
                                    <td>
                                        <b class='text text-warning'>Rp. {{ App\Models\InvoiceProduct::where('invoice_id', $data->id)->sum('price') }}</b>
                                    </td>
                                    <td>
                                        <b class='text text-success'>Rp.{{ $data->total }}</b>
                                    </td>
                                    <td>
                                        <b class='text text-primary'>Rp. {{ $data->total - App\Models\InvoiceProduct::where('invoice_id', $data->id)->sum('price') }}</b>
                                    </td>
                                    <td>{{ $data->tanggal_pembayaran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</body>
</html>