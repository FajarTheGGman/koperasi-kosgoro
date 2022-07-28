<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Roles;
use App\Models\MenuChild;
use App\Models\Privileges;
use App\Models\MenuParent;

class AclController extends Controller
{
    public function index(Request $users){
        $roles = Roles::all();
        $privileges = Privileges::with('roles', 'menu')->where('role_id', $users->session()->get('role_id'))->get();
        $menu_parent = MenuParent::all();
        return view('masterdata.acl', compact('roles', 'privileges', 'menu_parent'));
    }


    public function access($id){
        $roles = Roles::where('id', $id)->first();
        $menu_child = MenuChild::all();
        return view('masterdata.acl_access', compact('roles', 'menu_child'));
    }

    public function update_access(Request $user){
        for( $i = 0; $i < count($user->modify); $i++ ){
            $check = Privileges::where('role_id', $user->role_id)->where('menu_id', $user->modify[$i])->first();
            if($check){
                Privileges::where('role_id', $user->role_id)->where('menu_id', $user->modify[$i])->update([
                    'access' => isset($user->access[$i]) == true ? ($user->access[$i] == '1' ? 1 : 0) : 0,
                    'write' => isset($user->write[$i]) == true ? ($user->write[$i] == '1' ? 1 : 0) : 0,
                    'update' => isset($user->update[$i]) == true ? ($user->update[$i] == '1' ? 1 : 0) : 0,
                    'delete' => isset($user->delete[$i]) == true ? ($user->delete[$i] == '1' ? 1 : 0) : 0,
                ]);
                return back()->with('success', 'Data berhasil diubah');
            }else{
                Privileges::insert([
                    'role_id' => $user->role_id,
                    'menu_id' => $user->modify[$i],
                    'parent_id' => MenuChild::where('id', $user->modify[$i])->first()->menu_parent_id,
                    'access' => isset($user->access[$i]) == true ? ($user->access[$i] == '1' ? 1 : 0) : 0,
                    'write' => isset($user->write[$i]) == true ? ($user->write[$i] == '1' ? 1 : 0) : 0,
                    'update' => isset($user->update[$i]) == true ? ($user->update[$i] == '1' ? 1 : 0) : 0,
                    'delete' => isset($user->delete[$i]) == true ? ($user->delete[$i] == '1' ? 1 : 0) : 0,
                ]);
                return back()->with('success', 'Data berhasil ditambahkan');
            }
        }
    }
}
