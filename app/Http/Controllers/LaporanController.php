<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Invoice;

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
}
