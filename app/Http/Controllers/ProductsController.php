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
use App\Models\Invoice;

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
        $products = Cart::where('user_id', $users->id)->get();
        return view('products.cart', [
            'products' => $products,
            'supplier' => $supplier
        ]);
    }

    public function add_cart(Request $user, $id){
        $users = Users::where('email', $user->session()->get('email'))->first();
        $products = ProductsPurchase::where('id', $id)->first();
        $check = Cart::where('name', $products->name)->where('rack_id', $products->rack_id)->where('user_id', $users->id)->first();
        $users = Users::where('email', $user->session()->get('email'))->first();
        if(!$check){
            Cart::insert([
                'name' => $products->name,
                'type' => $products->type,
                'user_id' => $users->id,
                'name' => $products->name,
                'quantity' => 1,
                'price' => $products->price,
                'image' => $products->image,
                'barcode' => $products->barcode,
                'rack_id' => $products->rack_id,
                'sell_price' => $products->sell_price,
            ]);
            return back()->with('Success', 'Product has been added to cart');
        }else{
            return back()->with('Error', 'Product already exist in cart');
        }
    }

    public function delete_cart($id){
        try{
            $users = Users::where('email', Session::get('email'))->first();
            Cart::where('id', $id)->where('user_id', $users->id)->delete();
            return back()->with('Success', 'Product has been deleted from cart');
        }catch(\Exception $e){
            return back()->with('Error', 'Error Server');
        }
    }

    public function new_invoice(Request $user){
        $users = Users::where('email', $user->session()->get('email'))->first();
        $invoice = Invoice::where('user_id', $users->id)->get();
        $products = Cart::where('user_id', $users->id)->get();
        $total_harga = 0;
        $jumlah_barang = 0;
        foreach($products as $product){
            $total_harga += $product->price * $product->quantity;
            $jumlah_barang += $product->quantity;
        }
        foreach( $user->name as $key => $value){
            $check = Cart::where('name', $value)->where('user_id', $users->id)->first();
            $productsx = ProductsPurchase::where('name', $value)->first();
            if($check){
                $productsx->quantity = $productsx->quantity - $user->quantity[$key];
                $productsx->save();
                $check->quantity = $user->quantity[$key];
                $check->save();
            }
        }
        if($invoice->count() == 0){
            Invoice::insert([
                'user_id' => $users->id,
                'nomor_invoice' => 'PEMBELIAN-'.$users->id.'-'.date('Ymd'),
                'tanggal_pembelian' => date('Y-m-d'),
                'jumlah' => $jumlah_barang,
                'total' => $total_harga,
            ]);
        }
        return view('purchase.invoice', [
            'products' => $products,
            'invoice' => $invoice
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
        $enum_type = Enumeration::where('type', 'TypeProduct')->get();
        return view('products.edit', [
            'products' => $result,
            'enum_type' => $enum_type
        ]);
    }

    public function edit_post(Request $user){
        try{
            Products::where('id', $user->id)->update([
                'name' => $user->name,
                'quantity' => $user->quantity,
                'price' => $user->price,
                'type' => $user->type,
                'sell_price' => $user->sell_price,
            ]);
            return back()->with('Success', 'Product has been updated');
        }catch(\Exception $e){
            return back()->with('Error', 'Error Server');
        }
    }

    public function delete($id){
        Products::find($id)->delete();
        return back()->with('Success', 'Product has been deleted');
    }
}
