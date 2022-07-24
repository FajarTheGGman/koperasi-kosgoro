@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>Access Control</strong> Modify</h1>
            <div class='card'>
                <div class='card-body'>
                    <form>
                        <table class='table table-stripped' id='data'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Access</th>
                                    <th>Write</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $menu_child as $data )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <input type="checkbox" name="access[]" value="{{ $data->id }}" {{ $data->access == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="write[]" value="{{ $data->id }}" {{ $data->write == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="update[]" value="{{ $data->id }}" {{ $data->update == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="delete[]" value="{{ $data->id }}" {{ $data->delete == 1 ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $("#data").DataTable()
        });
    </script>
@endsection
