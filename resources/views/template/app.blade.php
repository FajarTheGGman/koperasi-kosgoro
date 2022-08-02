<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ url('/assets/img/icons/icon-48x48.png') }}" />
    <link rel="stylesheet" href="{{ url('/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/assets/css/dataTables.bootstrap5.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('/assets/css/toastr.min.css') }}"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Koperasi Kosgoro</title>

	<link href="{{ url('/assets/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('dashboard') }}">
                    <span class="align-middle">Koperasi <b class='text-success'>Kosgoro</b></span>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						List Menu
					</li>

                    {{--
					<li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.users' ? 'active' : '' }}">
						<a data-bs-target="#masterdata" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle" data-feather="database"></i> <span class="align-middle">Master Data</span>
						</a>
						<ul id="masterdata" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.users' ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('masterdata.users') }}">Users</a></li>

                            <li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.roles' ? 'active' : '' }}" ><a class="sidebar-link" href="{{ route('masterdata.roles') }}">Roles</a></li>
                            <li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.supplyer' ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('masterdata.supplyer') }}">Supplyer</a></li>
                            <li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.enumeration' ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('masterdata.enumeration') }}">Enumerations</a></li>
                            <li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.menu' ? 'active' : '' }}"><a class="sidebar-link" href="#">Menu List</a></li>
                            <li class="sidebar-item {{ Route::currentRouteName() == 'masterdata.acl' ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('masterdata.acl') }}">Access Control</a></li>

						</ul>
					</li>
                    --}}

                    @foreach( \App\Models\MenuParent::all() as $parent )
                        @if( $parent->name == 'Default' )
                            @foreach( \App\Models\Privileges::where('role_id', Session::get('role_id'))->where('access', 1)->get() as $menu )
                                @if( \App\Models\MenuParent::first()->id == \App\Models\MenuChild::where('id', $menu->menu_id)->first()->menu_parent_id )
                                    <li class="sidebar-item {{ Route::currentRouteName() == $menu->menu->name ? 'active' : '' }}">
                                        <a class="sidebar-link" href="{{ route($menu->menu->route) }}">
                                            <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">{{ $menu->menu->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                            @if( \App\Models\Privileges::where('role_id', Session::get('role_id'))->where('parent_id', $parent->id)->first())
        					    <li class="sidebar-item">
                                    <a data-bs-target="#{{ $parent->name }}" data-bs-toggle="collapse" class="sidebar-link">
                                        <i class="align-middle" data-feather={{ $parent->icons }}></i> <span class="align-middle">{{ $parent->name }}</span>
            						</a>
                                    <ul id="{{ $parent->name }}" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                                        @foreach( \App\Models\Privileges::where('role_id', Session::get('role_id'))->where('access', 1)->get() as $menu)
                                            @if( $parent->id == \App\Models\MenuChild::where('id', $menu->menu_id)->first()->menu_parent_id )
                                                <li class="sidebar-item"><a class="sidebar-link" href="{{ route($menu->menu->route) }}">{{ $menu->menu->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach

                    {{-- 
                        <li class="sidebar-item">
						<a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle" data-feather="box"></i> <span class="align-middle">Products</span>
						</a>
						<ul id="products" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('products.index') }}">Products</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rack.index') }}">Rack</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('products.warehouse') }}">Warehouse</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="#">Product Expired</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="#">Product Return</a></li>

						</ul>
					</li>


					<li class="sidebar-item">
						<a data-bs-target="#pemesanan" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Pemesanan</span>
						</a>
						<ul id="pemesanan" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li><a class="sidebar-link" href="{{ route('purchase.request') }}">Purchase Request</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('purchase.order') }}">Purchase Order</a></li>
                        </ul>
                    </li>

					<li class="sidebar-item">
						<a data-bs-target="#transaksi" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Transaksi</span>
						</a>
						<ul id="transaksi" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li><a class="sidebar-link" href="{{ route('purchase.request') }}">Transaksi Product</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('purchase.order') }}">Laporan Keuangan</a></li>
                        </ul>
                    </li>

					<li class="sidebar-item">
						<a data-bs-target="#laporan" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle" data-feather="alert-octagon"></i> <span class="align-middle">Laporan</span>
						</a>
						<ul id="laporan" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li><a class="sidebar-link" href="{{ route('purchase.request') }}">Laporan PO</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('purchase.order') }}">Laporan PR</a></li>
                        </ul>
                    </li>
                    --}}


					<li class="sidebar-header">
						Entrance
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('logout') }}">
                          <i class="align-middle text-primary" data-feather="circle"></i> <span class="align-middle">Change Password</span>
                        </a>

						<a class="sidebar-link" href="{{ route('logout') }}">
                          <i class="align-middle text-warning" data-feather="circle"></i> <span class="align-middle">Delete Account</span>
                        </a>

						<a class="sidebar-link" href="{{ route('logout') }}">
                          <i class="align-middle text-danger" data-feather="circle"></i> <span class="align-middle">Log out</span>
                        </a>
					</li>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon" href="{{ route('products.cart') }}" id="alertsDropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="shopping-cart"></i>
                                    @if( $cart != 0 )
                                        <span class="indicator">{{ $cart }}</span>
                                    @endif
								</div>
							</a>
    					</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
                                    @if( $notif->count() != 0 )
                                        <span class="indicator">{{ $notif->count() }}</span>
                                    @endif
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
                                    Notifications
								</div>
								<div class="list-group">
                                    @foreach( $notif as $data )
									<a class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
                                                <i class="text-success" data-feather="{{ $data->icons }}"></i>
											</div>
											<div class="col-10">
                                                <div class="text-dark">{{ $data->title }}</div>
                                                <div class="text-muted small mt-1">{{ $data->body }}</div>
                                                <div class="text-muted small mt-1">{{ $data->created_at }}</div>
											</div>
										</div>
									</a>
                                    @endforeach

								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="{{ Session::get('picture') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"{{ Session::get('fullname') }}</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

            @yield('content')

		</div>
	</div>

</body>

	<script src="https://demo.adminkit.io/js/app.js"></script>
    <script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js"/>
    <script src="{{ url('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ url('/assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>
        if("{{ session('Success') }}"){
            setTimeout(function () {
                toastr.options = {
                    "positionClass": "toast-top-right",
                    "closeButton": true,
                    "progressBar": true,
                    "showEasing": "swing",
                    "timeOut": "6000"
                };
                toastr.success("<strong>Success</strong> <br/><small>{{ session('Success') }}</small>");
            }, 1600)
        }else if("{{ session('Error') }}"){
            setTimeout(function () {
                toastr.options = {
                    "positionClass": "toast-top-right",
                    "closeButton": true,
                    "progressBar": true,
                    "showEasing": "swing",
                    "timeOut": "6000"
                };
                toastr.error("<strong>Errors</strong> <br/><small>{{ session('Error') }}</small>");
            }, 1600)
        }
    </script>

    @yield('js')

</html>
