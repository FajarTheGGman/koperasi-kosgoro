@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>Access Control</strong> Modify</h1>
            <div class='card'>
                <div class='card-body'>
                    <form action="{{ route('masterdata.acl.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $roles->id }}">
                        <table class='table table-stripped' id='data'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Modify</th>
                                    <th>Access</th>
                                    <th>Write</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $menu_child as $key => $data )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="hidden" name="menu_id[]" value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </td>
                                        <td>
                                            <input type="checkbox" name="modify[]" value="{{ $data->id }}" checked>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="access[]" value="1" {{ \App\Models\Privileges::where('menu_id', $data->id)->first()->access == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="write[]" value="1" {{ \App\Models\Privileges::where('menu_id', $data->id)->first()->write == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="update[]" value="1" {{ \App\Models\Privileges::where('menu_id', $data->id)->first()->update == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="delete[]" value="1" {{ \App\Models\Privileges::where('menu_id', $data->id)->first()->delete == 1 ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#data").DataTable()
        });
    </script>
@endsection
