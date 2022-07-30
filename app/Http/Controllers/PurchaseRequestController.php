<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProductsPurchase;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;
use App\Models\LaporanPR;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\Rack;

class PurchaseRequestController extends Controller
{
    public function request(){
        $purchase_request = PurchaseRequest::with('rack')->get();
        $products = Products::all();
        $rack = Rack::all();
        $supplier = Supplier::all();
        return view('purchase.request', [
            'purchase_request' => $purchase_request,
            'supplyer' => $supplier,
            'rack' => $rack,
            'products' => $products
        ]);
    }

    public function add(Request $user){
            $x = $user->all();
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
                    'rack_id' => $user->rack_id,
                    'expired_date' => $product->expired_date,
                    'total_income' => $product->total_income,
                    'status' => 'Process',
                ]);
                $total = $product->price++;
            }
            PurchaseRequest::insert([
                'name' => $user->name,
                'supplyer' => $user->supplyer,
                'rack_id' => $user->rack_id,
                'total_price' => $total,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            LaporanPR::insert([
                'name' => $user->name,
                'supplyer' => $user->supplyer,
                'rack_id' => $user->rack_id,
                'total_price' => $total,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return back()->with('Success', 'Purchase Request added successfully');
    }

    public function purchase_order($id){
                $pr = LaporanPR::where('rack_id', $id)->orderBy('id', 'DESC')->first();
                PurchaseOrder::insert([
                    'name' => $pr->name,
                    'supplyer' => $pr->supplyer,
                    'total_price' => $pr->total_price,
                    'pr_id' => $pr->id,
                    'status' => 'Process',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                PurchaseRequest::where('rack_id', $id)->update([
                    'status' => 'Process'
                ]);
                LaporanPR::where('rack_id', $id)->update([
                    'status' => 'Process'
                ]);
                return back()->with('Success', 'Purchase Order added successfully');

    }

    public function approve($id){
        $purchase_request = PurchaseRequest::find($id);
        $purchase_request->status = 'Approved';
        $purchase_request->save();
        return back();
    }

    public function delete($id){
        $purchase_request = PurchaseRequest::find($id);
        $purchase_request->delete();
        return back()->with('Success', 'Purchase Request deleted successfully');
    }
}
