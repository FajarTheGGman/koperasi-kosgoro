<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuParent;
use App\Models\MenuChild;

class MenuController extends Controller
{
    public function index()
    {
        $menu_parent = MenuParent::all();
        $menu_child = MenuChild::with('menu_parent')->get();
        return view('masterdata.menu', compact('menu_parent', 'menu_child'));
    }

    public function add_parent(Request $user){
        try{
            $check = MenuParent::where('name', $user->name)->first();
            if($check){
                return back()->with('error', 'Menu Parent sudah ada');
            }else{
                MenuParent::insert([
                    'name' => $user->name,
                    'description' => $user->description,
                ]);
                return back()->with('success', 'Data berhasil ditambahkan');
            }
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }

    public function add_child(Request $user){
            $check = MenuChild::where('name', $user->name)->first();
            if($check){
                return back()->with('error', 'Menu Child sudah ada');
            }else{
                MenuChild::insert([
                    'name' => $user->name,
                    'route' => $user->route,
                    'description' => $user->description,
                    'menu_parent_id' => $user->menu_parent_id,
                ]);
                return back()->with('success', 'Data berhasil ditambahkan');
            }

    }

    public function delete_child($id){
        try{
            MenuChild::where('id', $id)->delete();
            return back()->with('success', 'Data berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }

    public function delete_parent($id){
        try{
            MenuParent::where('id', $id)->delete();
            return back()->with('success', 'Data berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }


}
