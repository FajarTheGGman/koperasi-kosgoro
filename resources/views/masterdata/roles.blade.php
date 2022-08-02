@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>list</strong> roles</h1>
            <div class='card'>
                <div class='card-body'>
                    <button class='btn btn-primary mb-4' data-bs-toggle='modal' data-bs-target='#add'><i data-feather="star"></i> add role</button>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>description</th>
                                <th>action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $roles as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>
                                        <a href="{{ route('masterdata.roles.delete', $data->id) }}" class='btn btn-danger'><i data-feather='trash-2'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class='modal fade' id='add' tabindex='-1' role='dialog' aria-labelledby='addLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <form action="{{ route('masterdata.roles.add') }}" method='post'>
                            @csrf
                            <div class='modal-header'>
                                <b>New Roles</b>
                            </div>
                            <div class='modal-body'>
                                <div class='form-group'>
                                    <label for="name">Name Role</label>
                                    <input class='form-control' id='name' name='name' placeholder="Name Role"/>
                                </div>

                                <div class='form-group mt-4'>
                                    <label for="desc">Description</label>
                                    <input class='form-control' id='desc' name='desc' placeholder="Description"/>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
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
            $("#data").DataTable({
                responsive: true
            });
        })
    </script>
@endsection

