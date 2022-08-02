@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>Access Control</strong> List</h1>
            <div class='card'>
                <div class='card-body'>
                    <table class='table table-stripped' id='data'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $roles as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <a href="{{ route('masterdata.acl.access', $data->id) }}" class='btn btn-warning'><i data-feather='unlock'></i> Modfy Access</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
