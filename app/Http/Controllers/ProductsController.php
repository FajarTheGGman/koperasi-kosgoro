<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Products;
use App\Models\Supplier;
use App\Models\Rack;
use App\Models\PurchaseRequest;
use App\Models\Enumeration;
use App\Models\ProductsPurchase;
use App\Models\Cart;
use App\Models\Users;

class ProductsController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        $products = Products::all();
        $rack = Rack::all();
        $enum_type = Enumeration::where('type', 'TypeProduct')->get();
        return view('products.index', [
            'products' => $products,
            'suppliers' => $supplier,
            'racks' => $rack,
            'enum_type' => $enum_type,
        ]);
    }

    public function add_products(Request $user){
        $check = Products::where('name', $user->name)->first();
        if(!$check){
            Products::insert([
                'name' => $user->name,
                'quantity' => $user->quantity,
                'price' => $user->price,
                'type' => $user->type,
                'supplier_id' => $user->supplier,
                'sell_price' => $user->sell_price,
                'image' => 'default.png',
            ]);
            return back()->with('Success', 'Product has been added');
        }else{
            return back()->with('Error', 'Product already exist');
        }
    }

    public function warehouse(){
        $supplier = Supplier::all();
        $products = ProductsPurchase::with('rack')->where('status', 'Sold')->get();
        return view('products.warehouse', [
            'products' => $products,
            'supplier' => $supplier
        ]);
    }

    public function warehouse_delete($id){
        ProductsPurchase::where('id', $id)->delete();
        return back()->with('Success', 'Product has been deleted');
    }

    public function store(){
        $supplier = Supplier::all();
        $products = ProductsPurchase::with('rack')->where('status', 'Sold')->get();
        return view('products.store', [
            'products' => $products,
            'supplier' => $supplier
        ]);
    }

    public function cart(Request $user){
        $supplier = Supplier::all();
        $users = Users::where('email', $user->session()->get('email'))->first();
        $products = Cart::with('rack')->where('user_id', $users)->get();
        return view('products.cart', [
            'products' => $products,
            'supplier' => $supplier
        ]);
    }

    public function add(Request $user){
        try{
            if(!empty($user->file('image'))){
                $user->file('image')->move('./image', $user->file('image')->getClientOriginalName());
            }

            Products::insert([
                'name' => $user->name,
                'quantity' => $user->quantity,
                'price' => $user->price,
                'type' => $user->type,
                'image' => 'default.png',
                'sell_price' => $user->sell_price,
                'barcode' => 'none',
                'expired_date' => $user->expired,
                'total_income' => preg_match('/bundle/i', $user->type) ? $user->quantity * $user->price : $user->quantity * $user->price,
            ]);
            return back()->with('Success', 'Product has been added');
        }catch(\Exception $e){
            return back()->with('Error', 'Product already exist');
        }
    }

    public function purchase_request(){
        $get = Products::all();
        foreach($get as $products){
            PurchaseRequest::insert([
                'name' => $products->name,
                'quantity' => $products->quantity,
                'price' => $products->price,
                'type' => $products->type,
                'image' => $products->image,
                'supplier_id' => $products->supplier_id,
                'status' => 'Pending',
                'sell_price' => $products->sell_price,
                'rak' => $products->rak
            ]);
        }
        return back()->with('Success', 'Purchase Request has been added');
    }

    public function edit($id){
        $result = Products::find($id);
        return view('products.edit', [
            'name' => $result->name,
            'price' => $result->price,
            'type' => $result->type
        ]);
    }

    public function delete($id){
        Products::find($id)->delete();
        return back()->with('Success', 'Product has been deleted');
    }
}
