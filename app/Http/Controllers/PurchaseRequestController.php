<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProductsPurchase;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\Rack;

class PurchaseRequestController extends Controller
{
    public function request(){
        if(Session::has('email')){
            $purchase_request = PurchaseRequest::with('rack');
            $products = Products::with('rack')->get();
            $rack = Rack::all();
            $supplier = Supplier::all();
            return view('purchase.request', [
                'purchase_request' => $purchase_request->get(),
                'supplyer' => $supplier,
                'rack' => $rack,
                'products' => $products
            ]);
        }else{
            return back();
        }
    }

    public function add(Request $user){
        if(Session::has('email')){
            $x= $user->all();
            $x['product_id'] = $user->product_id;
            $total = 0;
            foreach($x['product_id'] as $product_id){
                $product = Products::find($product_id);
                ProductsPurchase::insert([
                    'name' => $product->name,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'type' => $product->type,
                    'sell_price' => $product->sell_price,
                    'image' => 'default.png',
                    'barcode' => $product->barcode,
                    'rack_id' => $product->rack_id,
                    'expired_date' => $product->expired_date,
                    'total_income' => $product->total_income
                ]);
                $total += $product->price;
            }
                PurchaseRequest::insert([
                    'name' => $user->name,
                    'supplyer' => $user->supplyer,
                    'rack_id' => $user->rack_id,
                    'status' => 'Pending',
                    'total_price' => $total,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                return back()->with('Success', 'Purchase Request added successfully');
        }else{
            return back()->with('Error', 'You are not logged in');
        }
    }

    public function purchase_order($id){
        if(Session::has('email')){
            try{
                PurchaseOrder::insert([
                    'purchase_request_id' => $id,
                    'status' => 'Pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }catch(\Exception $e){
                return back()->with('Error', $e);
            }
        }else{
            return back();
        }
    }

    public function approve($id){
        if(Session::has('email')){
            $purchase_request = PurchaseRequest::find($id);
            $purchase_request->status = 'Approved';
            $purchase_request->save();
            return back();
        }else{
            return back();
        }
    }

    public function delete($id){
        if(Session::has('email')){
            $purchase_request = PurchaseRequest::find($id);
            $purchase_request->delete();
            return back();
        }else{
            return back();
        }
    }
}
