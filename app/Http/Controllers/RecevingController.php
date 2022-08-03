<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsPurchase;
use App\Models\PurchaseRequest;
use App\Models\PurchaseOrder;

class RecevingController extends Controller
{
    public function index(Request $user)
    {
        $purchase_order = PurchaseOrder::where('status', 'Receiving')->get();
        return view('purchase.receving', compact('purchase_order'));
    }
}
