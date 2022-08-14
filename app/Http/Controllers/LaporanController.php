<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Invoice;
use App\Models\ProductsPurchase;

class LaporanController extends Controller
{
    public function index(){
        $users = Users::all();
        $invoice = Invoice::all();
        return view('laporan.index', compact('users', 'invoice'));
    }

    public function gaji(){
        $users = Users::all();
        $invoice = Invoice::where('status_pembayaran', 'Paid')->where('payment', 'Potong Gaji')->get();
        return view('laporan.gaji', compact('users', 'invoice'));
    }

    public function laba(){
        $users = Users::all();
        $invoice = Invoice::where('status_pembayaran', 'Paid')->where('status_pembayaran', 'Paid')->get();
        $products = ProductsPurchase::all();
        return view('laporan.laba', compact('users', 'invoice', 'products'));
    }
}
