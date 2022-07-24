<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Roles;

class RolesController extends Controller
{
    public function index(){
        if(Session::has('email')){
            $roles = Roles::all();
            return view('masterdata.roles', compact('roles'));
        }else{
            return back();
        }
    }

    public function add(Request $user){
        if(Session::has('email')){
            try{
                $check = Roles::where('name', $user->name)->first();
                if(!$check){
                    Roles::insert([
                        'name' => $user->name,
                        'description' => $user->desc
                    ]);
                    return back()->with('Success', 'Role has been added');
                }else{
                    return back()->with('Error', 'Role already exist');
                }
            }catch(\Exception $e){
                return back()->with('Error', $e->getMessage());
            }
        }else{
            return back();
        }
    }

    public function delete($id){
        if(Session::has('email')){
            try{
                $role = Roles::find($id);
                $role->delete();
                return back()->with('Success', 'Role has been deleted');
            }catch(\Exception $e){
                return back()->with($e);
            }
        }else{
            return back();
        }
    }
}
