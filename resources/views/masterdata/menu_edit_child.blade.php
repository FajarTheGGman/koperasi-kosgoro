@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Menu Child</strong> {{ $menu_child->name }}</h1>
            <a href="{{ route('masterdata.menu') }}" class="btn btn-primary mb-4"><i data-feather="arrow-left"></i> Back</a>
            <div class='card'>
                <div class='card-body'>
                    <form action={{ route('masterdata.menu.child.edit.update') }} method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $menu_child->id }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $menu_child->name }}">
                        </div>
                        <!-- route -->
                        <div class="form-group mt-2">
                            <label for="route">Route</label>
                            <input type="text" class="form-control" id="route" name="route" value="{{ $menu_child->route }}">
                        </div>
                        <!-- menu parent -->
                        <div class="form-group mt-2">
                            <label for="menu_parent_id">Menu Parent</label>
                            <select class="form-control" id="menu_parent_id" name="menu_parent_id">
                                <option value="">-- Select Menu Parent --</option>
                                @foreach($menu_parents as $menu_parent)
                                    <option value="{{ $menu_parent->id }}" {{ $menu_child->menu_parent_id == $menu_parent->id ? 'selected' : '' }}>{{ $menu_parent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $menu_child->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

