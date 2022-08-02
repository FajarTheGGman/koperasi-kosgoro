@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>List</strong> Users</h1>
            <div class='card'>
                <div class='card-body'>
                    <button type='button' class='btn btn-primary mb-4' data-bs-toggle='modal' data-bs-target='#addUser'><i data-feather="user-plus"></i> New Users</button>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach( $users as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->fullname }}</td>
                                    <td>{{ $data->roles->name }}</td>
                                    <th>
                                        <a href='#' class='btn btn-sm btn-warning'><i data-feather='edit-2'></i></a>
                                        <a href="{{ route('masterdata.users.delete', $data->id) }}" class='btn btn-sm btn-danger'><i data-feather='trash-2'></i></a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Add User -->
            <div class='modal fade' id='addUser' tabindex='-1' role='dialog' aria-labelledby='addUserLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <form action="{{ route('masterdata.users.create') }}" method='post'>
                            @csrf
                            <div class='modal-header'>
                                <b class='modal-title' id='addUserLabel'>Add User</b>
                            </div>
                            <div class='modal-body'>
                                <div class='form-group'>
                                    <label for='fullname'>Full Name</label>
                                    <input type='text' class='form-control' id='fullname' name='fullname' placeholder='Full Name'>
                                </div>

                                <div class='form-group mt-4'>
                                    <label for='email'>Email</label>
                                    <input type='email' class='form-control' id='email' name='email' placeholder='Email'>
                                </div>

                                <div class='form-group mt-4'>
                                    <label for='password'>Password</label>
                                    <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
                                </div>

                                <div class='form-group mt-4'>
                                    <label for='role'>Role</label>
                                    <select class='form-control' id='role_id' name='role_id'>
                                        @foreach( $roles as $role )
                                            <option value={{ $role->id }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
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
            $('#data').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
