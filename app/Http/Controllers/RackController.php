<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Rack;

class RackController extends Controller
{
    public function index(Request $user){
        if(Session::has('email')){
            try{
                $data = Rack::all();
                return view('masterdata.rack', compact('data'));
            }catch(\Exception $e){
                return back()->with('Error', $e->getMessage());
            }
        }else{
            return back();
        }
    }

    public function add(Request $user){
        if(Session::has('email')){
                Rack::insert([
                    'name' => $user->name,
                    'description' => $user->description,
                ]);
                return back()->with('Success', 'Data successfully added');

        }else{
            return back();
        }
    }

    public function edit(Request $user){
        if(Session::has('email')){
            try{
                Rack::where('id', $user->id)->update([
                    'name' => $user->name,
                    'description' => $user->description,
                ]);
                return back()->with('Success', 'Data successfully updated');
            }catch(\Exception $e){
                return back()->with('Error', $e->getMessage());
            }
        }else{
            return back();
        }
    }

    public function delete(Request $user){
        if(Session::has('email')){
            try{
                Rack::where('id', $user->id)->delete();
                return back()->with('Success', 'Data successfully deleted');
            }catch(\Exception $e){
                return back()->with('Error', $e->getMessage());
            }
        }else{
            return back();
        }
    }
}
