@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
		    <h1 class="h3 mb-3"><strong>Menu</strong> List</h1>
            <button class='btn btn-primary mb-4' data-bs-toggle='modal' data-bs-target='#add_parent'><i data-feather="tag"></i> Add Parent</button>

            <button class='btn btn-warning mb-4' data-bs-toggle='modal' data-bs-target='#add_child'><i data-feather="tag"></i> Add Child</button>
            <div class='card'>
                <div class='card-body'>
                    <div class='col'>
                        <b>Menu Parent</b>
                        <table id='data' class='table'>
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Icons</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach( $menu_parent as $data )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <i data-feather="{{ $data->icons }}"></i>
                                        </td>
                                        <td>{{ $data->description }}</td>
                                        <td>
                                            <a href='{{ route('masterdata.menu.parent.edit', $data->id) }}' class='btn btn-warning'>Edit</a>
                                            <a href="{{ route('masterdata.menu.parent.delete', $data->id) }}" class='btn btn-danger'>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-body'>
                    <div class='col'>
                        <b>Menu Child</b>
                        <table id='data2' class='table'>
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Menu Parent</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach( $menu_child as $data )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->route }}</td>
                                        <td>{{ $data->menu_parent->name }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>
                                            <a href="{{ route('masterdata.menu.child.edit', $data->id) }}" class='btn btn-warning btn-sm'>Edit</a>
                                            <a href="{{ route('masterdata.menu.child.delete', $data->id) }}" class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- modal add parernt -->
            <div class='modal fade' id='add_parent' tabindex='-1' role='dialog' aria-labelledby='add' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <form action="{{ route('masterdata.menu.parent.add') }}" method="post">
                        @csrf
                            <div class='modal-header'>
                                <b class='modal-title' id='add'>Add Parent</b>
                            </div>
                            <div class='modal-body'>
                                <div class='form-group'>
                                    <label for='name'>Name</label>
                                    <input type='text' name='name' class='form-control' id='name' placeholder='Name'>
                                </div>
                                <div class='form-group mt-2'>
                                    <label for='description'>Description</label>
                                    <input type='text' name='description' class='form-control' id='description' placeholder='Description'>
                                </div>
                                <!-- form icons -->
                                <div class='form-group mt-2'>
                                    <label for='icons'>Icons</label>
                                    <input type='text' name='icons' class='form-control' id='icons' placeholder='Icons'>
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

            <div class='modal fade' id='add_child' tabindex='-1' role='dialog' aria-labelledby='add' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <b class='modal-title' id='add'>Add Child</b>
                        </div>
                        <div class='modal-body'>
                            <form action="{{ route('masterdata.menu.child.add') }}" method="post">
                                @csrf
                                <div class='form-group'>
                                    <label for='name'>Name</label>
                                    <input type='text' name='name' class='form-control' id='name' placeholder='Name'>
                                </div>
                                <!-- route -->
                                <div class='form-group mt-2'>
                                    <label for='route'>Route</label>
                                    <input type='text' name='route' class='form-control' id='route' placeholder='Route'>
                                </div>
                                <!-- menu_parent_id -->
                                <div class='form-group mt-2'>
                                    <label for='menu_parent_id'>Menu Parent</label>
                                    <select name='menu_parent_id' class='form-control' id='menu_parent_id'>
                                        <option value=''>-- Select Menu Parent --</option>
                                        @foreach( $menu_parent as $data )
                                            <option value='{{ $data->id }}'>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class='form-group mt-2'>
                                    <label for='description'>Description</label>
                                    <input type='text' name='description' class='form-control' id='description' placeholder='Description'>
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

        </div>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#data").DataTable({
                responsive: true
            });
            $("#data2").DataTable({
                responsive: true
            });
        })
    </script>
@endsection

