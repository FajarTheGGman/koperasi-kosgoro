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
}
