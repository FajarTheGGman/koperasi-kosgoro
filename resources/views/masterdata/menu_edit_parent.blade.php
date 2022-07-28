@extends('.template.app')

@section('content')
	<main class="content">
	    <div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Menu Parent</strong> {{ $menu_parent->name }}</h1>
            <a href="{{ route('masterdata.menu') }}" class="btn btn-primary mb-4"><i data-feather="arrow-left"></i> Back</a>
            <div class='card'>
                <div class='card-body'>
                    <form action={{ route('masterdata.menu.parent.edit.update') }} method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $menu_parent->id }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $menu_parent->name }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="icons">Icons</label>
                            <input type="text" class="form-control" id="icons" name="icons" value="{{ $menu_parent->icons }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $menu_parent->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

