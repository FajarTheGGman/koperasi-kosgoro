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

class ProductsController extends Controller
{
    public function index(){
        if(Session::has('email')){
            $supplier = Supplier::all();
            $products = Products::with('rack')->get();
            $rack = Rack::all();
            $enum_type = Enumeration::where('type', 'TypeProduct')->get();
            return view('products.index', [
                'products' => $products,
                'suppliers' => $supplier,
                'racks' => $rack,
                'enum_type' => $enum_type,
            ]);
        }else{
            return back();
        }
    }

    public function add_products(Request $user){
        if(Session::has('email')){
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
                        'rack_id' => $user->rack_id,
                    ]);
                    return back()->with('Success', 'Product has been added');
                }else{
                    return back()->with('Error', 'Product already exist');
                }
        }
    }

    public function warehouse(){
        if(Session::has('email')){
            $supplier = Supplier::all();
            $products = DB::table('products')->select('supplyer.id as sid', 'products.id', 'products.name', 'products.quantity', 'products.price', 'products.type', 'products.image', 'supplyer.nama', 'products.sell_price', 'products.rak')->join('supplyer', 'products.supplier_id', '=', 'supplyer.id')->get();
            return view('products.index', [
                'products' => $products,
                'supplier' => $supplier
            ]);
        }else{
            return back();
        }
    }

    public function add(Request $user){
        if(Session::has('email')){
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
                    'rack_id' => $user->rack_id,
                ]);
                toast('Berhasil menambahkan data', 'success');
                return back();
            }catch(\Exception $e){
                dd($e);
                toast('Gagal menambahkan data', 'error');
                return back();
            }
        }else{
            return back();
        }
    }

    public function purchase_request(){
        if(Session::has('email')){
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
            toast('Berhasil menambahkan data', 'success');
            return back();
        }else{
            return back();
        }
    }

    public function edit($id){
        if(Session::has('email')){
            $result = Products::find($id);
            return view('products.edit', [
                'name' => $result->name,
                'price' => $result->price,
                'type' => $result->type
            ]);
        }else{
            return back();
        }
    }

    public function delete($id){
        if(Session::has('email')){
            Products::find($id)->delete();
            toast('Berhasil menghapus data', 'success');
            return back();
        }else{
            toast('Gagal menghapus data', 'error');
            return back();
        }
    }
}
