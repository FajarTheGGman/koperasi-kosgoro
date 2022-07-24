@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>Warehouse</strong> Rack</h1>
            <div class='card'>
                <div class='card-body'>
                    <button class='btn btn-primary mb-4' data-bs-toggle='modal' data-bs-target='#add'><i data-feather="tag"></i> Add Rack</button>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $data as $rack )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rack->name }}</td>
                                    <td>{{ $rack->description }}</td>
                                    <td>
                                        <a href='#' class='btn btn-warning'>Edit</a>
                                        <a href="{{ route('rack.delete', $rack->id) }}" class='btn btn-danger'>Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- add rack -->
            <div class='modal fade' id='add' tabindex='-1' role='dialog' aria-labelledby='add' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <form action="{{ route('rack.create') }}" method='post'>
                            @csrf
                            <div class='modal-header'>
                                <h4 class='modal-title' id='add'><b>Add Rack</b></h4>
                            </div>
                            <div class='modal-body'>
                                    <div class='form-group'>
                                        <label for='name'>Name</label>
                                        <input type='text' class='form-control' id='name' name='name' placeholder='Name'>
                                    </div>
                                    <div class='form-group mt-4'>
                                        <label for='description'>Description</label>
                                        <textarea class='form-control' id='description' name='description' rows='3' placeholder='Description'></textarea>
                                    </div>
                            </div>

                            <div class='modal-footer'>
                                <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-primary'>Save</button>
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
            $("#data").DataTable()
        })
    </script>
@endsection

 
