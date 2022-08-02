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
        try{
            $this->validate($user, [
                'name' => 'required',
                'product_id' => 'required',
            ]);
            $x = $user->all();
            $x['product_id'] = $user->product_id;
            $total = 0;
            LaporanPR::insert([
                'name' => $user->name,
                'supplyer' => $user->supplyer,
                'rack_id' => $user->rack_id,
                'total_price' => $total,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            foreach($x['product'] as $key => $product){
                $qty = (int) $x['quantity'][$product];
                $product = Products::find($x['product_id'][$key]);
                ProductsPurchase::insert([
                    'name' => $product->name,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'type' => $product->type,
                    'sell_price' => $product->sell_price,
                    'image' => $product->image,
                    'barcode' => $product->id.'/'.Rack::where('id', $user->rack_id)->first()->name.'/'.$product->expired_date,
                    'rack_id' => $user->rack_id,
                    'pr_id' => LaporanPR::orderBy('id', 'desc')->first()->id,
                    'expired_date' => $product->expired_date,
                    'total_income' => $product->price * $qty,
                    'status' => 'Process',
                ]);
            }

            $p = ProductsPurchase::where('pr_id', LaporanPR::orderBy('id', 'desc')->first()->id)->get();
            foreach( $p as $upqty){
                $total += $upqty->price * $upqty->quantity;
            }

            PurchaseRequest::insert([
                'name' => $user->name,
                'supplyer' => $user->supplyer,
                'rack_id' => $user->rack_id,
                'total_price' => $total,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $laporanPr = LaporanPR::orderBy('id', 'desc')->first();
            $laporanPr->update([
                'total_price' => $total,
            ]);
            return back()->with('Success', 'Purchase Request added successfully');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
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
