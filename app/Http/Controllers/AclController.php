<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Roles;
use App\Models\MenuChild;
use App\Models\Privileges;

class AclController extends Controller
{
    public function index(Request $users){
        $roles = Roles::all();
        return view('masterdata.acl', compact('roles'));
    }

    public function access($id){
        $roles = Roles::find($id);
        $menu_child = MenuChild::all();
        return view('masterdata.acl_access', compact('roles', 'menu_child'));
    }
}
