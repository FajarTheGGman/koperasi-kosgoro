<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    public function index(){
        if(Session::has('email')){
            $purchase_order = DB::table('purchase_order')->select('supplyer.id as sid', 'purchase_order.id', 'purchase_order.status','purchase_order.name', 'purchase_order.quantity', 'purchase_order.price', 'purchase_order.type', 'purchase_order.image', 'supplyer.nama', 'purchase_order.sell_price', 'purchase_order.rak')->join('supplyer', 'purchase_order.supplier_id', '=', 'supplyer.id')->get();
            return view('purchase.order', ['purchase_order' => $purchase_order]);
        }else{
            return back();
        }
    }

    public function invoice(){
        if(Session::has('email')){
            return view('purchase.invoice');
        }else{
            return back();
        }
    }
}
