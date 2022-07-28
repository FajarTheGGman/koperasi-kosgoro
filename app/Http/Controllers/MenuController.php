<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuParent;
use App\Models\MenuChild;
use App\Models\Notification;

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
                return back()->with('Error', 'Menu Child sudah ada');
            }else{
                MenuChild::insert([
                    'name' => $user->name,
                    'route' => $user->route,
                    'description' => $user->description,
                    'menu_parent_id' => $user->menu_parent_id,
                ]);
                return back()->with('Success', 'Data berhasil ditambahkan');
            }
    }

    public function edit_parent($id){
        $menu_parent = MenuParent::where('id', $id)->first();
        return view('masterdata.menu_edit_parent', compact('menu_parent'));
    }

    public function edit_child($id){
        $menu_child = MenuChild::where('id', $id)->first();
        $menu_parents = MenuParent::all();
        return view('masterdata.menu_edit_child', compact('menu_child', 'menu_parents'));
    }

    public function update_parent(Request $user){
        try{
            MenuParent::where('id', $user->id)->update([
                'name' => $user->name,
                'icons' => $user->icons,
                'description' => $user->description,
            ]);
            return back()->with('Success', 'Data berhasil diubah');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }

    public function update_child(Request $user){
        try{
            MenuChild::where('id', $user->id)->update([
                'name' => $user->name,
                'route' => $user->route,
                'description' => $user->description,
                'menu_parent_id' => $user->menu_parent_id,
            ]);
            return back()->with('Success', 'Data berhasil diubah');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
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
            return back()->with('Success', 'Data berhasil dihapus');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }


}
