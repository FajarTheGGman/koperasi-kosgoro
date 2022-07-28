<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PurchaseOrder;
use App\Models\ProductsPurchase;
use App\Models\PurchaseRequest;

class PurchaseOrderController extends Controller
{
    public function index(){
        $purchase_order = PurchaseOrder::with('purchase_request')->get();
        return view('purchase.order', ['purchase_order' => $purchase_order]);
    }

    public function approve($id){
        $purchase_order = PurchaseOrder::with('purchase_request')->where('id', $id)->first();
        $product_purchase = ProductsPurchase::where('rack_id', $purchase_order->purchase_request->rack_id)->get();
        foreach($product_purchase as $product){
            ProductsPurchase::where('id', $product->id)->update([
                'status' => 'Sold'
            ]);
        }
        PurchaseRequest::where('rack_id', $purchase_order->purchase_request->rack_id)->delete();
        PurchaseOrder::where('id', $id)->update([
            'status' => 'Approved'
        ]);
        return back()->with('Success', 'Data berhasil di approve');
    }

    public function delete($id){
        $purchase_order = PurchaseOrder::find($id);
        $purchase_order->delete();
        return back()->with('Success', 'Data berhasil dihapus');
    }

    public function invoice(){
        return view('purchase.invoice');
    }
}
