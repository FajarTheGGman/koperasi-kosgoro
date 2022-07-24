@extends(".template.app")

@section("content")
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Products</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class='card'>
            <div class='card-header'>
                <h4><b>Edit Products</b></h4>
            </div>

            <div class='card-body'>
                <form class='form'>
                    <input type='text' class='form-control' placeholder="Name" value={{ $name }} />
                </form>
            </div>
        </div>
      </div>
    </div>
   </div>
@endsection
