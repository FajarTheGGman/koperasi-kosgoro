<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\EnumerationController;
use App\Http\Controllers\AclController;
use App\Http\Controllers\MenuController;

use App\Models\Products;
use App\Models\Supplier;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;
use App\Models\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('Auth');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('authentication');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/logout', function(){
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});

Route::group(['prefix' => 'masterdata', "middleware" => ['Auth']], function(){
    Route::get('/users', [UsersController::class, 'index'])->name('masterdata.users');
    Route::get('/users/delete/{id}', [UsersController::class, 'delete'])->name('masterdata.users.delete');
    Route::post('/users/create', [UsersController::class, 'register'])->name('masterdata.users.create');

    Route::get('/supplyer', [SupplierController::class, 'index'])->name('masterdata.supplyer');
    Route::get('/supplyer/delete/{id}', [SupplierController::class, 'delete'])->name('masterdata.supplyer.delete');
    Route::post('/supplyer/add', [SupplierController::class, 'add'])->name('masterdata.supplyer.add');

    Route::get('/roles', [RolesController::class, 'index'])->name('masterdata.roles');
    Route::get('/roles/delete/{id}', [RolesController::class, 'delete'])->name('masterdata.roles.delete');
    Route::post('/roles/add', [RolesController::class, 'add'])->name('masterdata.roles.add');

    // Route Previleges
    Route::get('/acl', [AclController::class, 'index'])->name('masterdata.acl');
    Route::get('/acl/access/{id}', [AclController::class, 'access'])->name('masterdata.acl.access');
    Route::post('/acl/update', [AclController::class, 'update_access'])->name('masterdata.acl.update');

    // Menu List
    Route::get('/menu', [MenuController::class, 'index'])->name('masterdata.menu');
    Route::post('/menu/parent/add', [MenuController::class, 'add_parent'])->name('masterdata.menu.parent.add');
    Route::post('/menu/child/add', [MenuController::class, 'add_child'])->name('masterdata.menu.child.add');
    Route::get('/menu/parent/delete/{id}', [MenuController::class, 'delete_parent'])->name('masterdata.menu.parent.delete');
    Route::get('/menu/child/delete/{id}', [MenuController::class, 'delete_child'])->name('masterdata.menu.child.delete');

    // route enumeration
    Route::get('/enumeration', [EnumerationController::class, 'index'])->name('masterdata.enumeration');
    Route::get('/enumeration/delete/{id}', [EnumerationController::class, 'delete'])->name('masterdata.enumeration.delete');
    Route::post('/enumeration/add', [EnumerationController::class, 'add'])->name('masterdata.enumeration.add');
});

Route::group(['prefix' => 'purchase', 'middleware' => 'Auth'], function(){
    Route::get('/request', [PurchaseRequestController::class, 'request'])->name('purchase.request');
    Route::post('/request/add', [PurchaseRequestController::class, 'add'])->name('purchase.request.add');
    Route::get('/request/delete/{id}', [PurchaseRequestController::class, 'delete'])->name('purchase.request.delete');
    Route::get('/request/approve/{id}', [PurchaseRequestController::class, 'approve'])->name('purchase.request.approve');
    Route::get('/request/order', [PurchaseRequestController::class, 'purchase_order'])->name('purchase.request.order');
    Route::get('/order', [PurchaseOrderController::class, 'index'])->name('purchase.order');
    Route::get('/order/invoice', [PurchaseOrderController::class, 'invoice'])->name('purchase.invoice');
});

Route::group(['prefix' => 'products', 'middleware' => 'Auth'], function(){
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/warehouse', [ProductsController::class, 'warehouse'])->name('products.warehouse');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('products.delete');
    Route::post('/add', [ProductsController::class, 'add'])->name('products.create');
    Route::get('/request', [ProductsController::class, 'purchase_request'])->name('products.purchase_request');
    Route::get('/checkout', [ProductsController::class, 'purchase_order'])->name('products.checkout');
});

// rack route
Route::group(['prefix' => 'rack', 'middleware' => 'Auth'], function(){
    Route::get('/', [RackController::class, 'index'])->name('rack.index');
    Route::get('/edit/{id}', [RackController::class, 'edit'])->name('rack.edit');
    Route::get('/delete/{id}', [RackController::class, 'delete'])->name('rack.delete');
    Route::post('/add', [RackController::class, 'add'])->name('rack.create');
});

Route::fallback(function () {
    return view('404');
});
