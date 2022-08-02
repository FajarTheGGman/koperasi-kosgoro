@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Supplyer</strong> Products</h1>
            <div class='card'>
                <div class='card-header'>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#add" class='btn btn-primary btn-sm'><i data-feather="plus"></i> Add New</button>
                </div>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Atas Nama</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $data as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->atas_nama}}</td>
                                    <td>{{ $s->alamat }}</td>
                                    <td>{{ $s->no_telp }}</td>
                                    <td>
                                        <a href="{{ route('masterdata.supplyer.delete', $s->id) }}" class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- input supplyer modal with every form-group mt-4 -->
            <div class='modal fade' id='add' tabindex='-1' role='dialog' aria-labelledby='addLabel' aria-hidden='true'>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('masterdata.supplyer.add') }}" method='post' enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addLabel">Add New Supplyer</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Supplyer</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="atas_nama">Atas Nama</label>
                                    <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="alamat mt-4">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="no_telp">No Telepon</label>
                                    <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
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
                                
