<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Roles;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;
use App\Models\Privileges;
use App\Models\MenuParent;
use App\Models\Invoice;
use App\Models\ProductsPurchase;

class AuthController extends Controller
{
    public function index(){
        $check = Users::where('email', 'admin@koperasi.sch.id')->first();
        if(!$check){
            Roles::create([
                'name' => 'admin',
                'description' => 'Admin Role'
            ]);

            Users::create([
                'email' => 'admin@koperasi.sch.id',
                'fullname' => 'Admin Koperasi',
                'picture' => 'https://avatars.dicebear.com/api/initials/admin koperasi.png',
                'password' => Hash::make('admin'),
                'role_id' => Roles::all()->first()->id
            ]);
        }

        if(Session::has('email')){
            return redirect()->route('dashboard');
        }

        return view('auth.login', ['roles' => Roles::all()]);
    }

    public function dashboard(Request $user){
        $privileges = Privileges::with('roles', 'menu')->where('role_id', $user->session()->get('role_id'))->get();
        $menu_parent = MenuParent::all();
        $earnings = Invoice::where('status_pembayaran', 'Paid')->sum('total');
        $invoice = Invoice::take(10)->get();
        $purchase_order = PurchaseOrder::take(10)->get();
        $warehouse = ProductsPurchase::where('status', 'Sold')->get();

        return view('index', [
            'products' => Products::all(),
            'suppliers' => Supplier::all(),
            'purchase_requests' => PurchaseRequest::all(),
            'purchase_orders' => PurchaseOrder::all(),
            'users' => Users::all(),
            'roles' => Roles::all(),
            'privileges' => $privileges,
            'menu_parent' => $menu_parent,
            'earnings' => $earnings,
            'invoice' => $invoice,
            'warehouse' => $warehouse
        ]);
    }

    public function register(Request $user){
        $email = $user->email;
        $password = Hash::make($user->password);
        $role = $user->role;
        $check = Users::where('email', $email)->first();
        if($check){
            return response()->json([
                'message' => 'Email already exist'
            ], 400);
        }else{
            $newUser = new Users;
            $newUser->email = $email;
            $newUser->password = $password;
            $newUser->role = $role;
            $newUser->save();
            return response()->json([
                'message' => 'User created'
            ], 200);
        }
    }

    public function login(Request $users){
        $user = Users::where('email', $users->email)->first();
        if($user){
            if(Hash::check($users->password, $user->password)){
                $users->session()->put([
                    'email' => $user->email,
                    'fullname' => $user->fullname,
                    'picture' => $user->picture,
                    'role_id' => $user->role_id
                ]);
                return redirect()->route('dashboard');
            }else{
                return back()->with('Wrong', 'Usename or Password is wrong');
            }
        }else{
            return back()->with('Wrong', 'Usename or Password is wrong');
        }
    }
}
