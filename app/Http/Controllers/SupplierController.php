<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    public function index(){
        if(Session::has('email')){
            return view('masterdata.supplyer', ['data' => Supplier::all()]);
        }else{
            return back();
        }
    }

    public function add(Request $user){
        if(Session::has('email')){
            $check = Supplier::where('nama', $user->name)->first();
            if($check){
                toast('Data already exist', 'warning');
                return back()->with('error', 'Data already exist');
            }else{
                $supplyer = new Supplier;
                $supplyer->nama = $user->nama;
                $supplyer->atas_nama = $user->atas_nama;
                $supplyer->alamat = $user->alamat;
                $supplyer->no_telp = $user->no_telp;
                $supplyer->save();
                toast('Supplyer successfully addded!', 'success');
                return back();
            }
        }else{
            return back();
        }
    }

    public function delete($id){
        if(Session::has('email')){
            $supplyer = Supplier::find($id);
            $supplyer->delete();
            toast('Data successfully deleted','success');
            return back();
        }else{
            return back();
        }
    }
}
