<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Enumeration;

class EnumerationController extends Controller
{
    public function index()
    {
        $enumerations = Enumeration::all();
        return view('masterdata.enumeration', compact('enumerations'));
    }

    public function add(Request $user)
    {
        try{
            Enumeration::insert([
                'name' => $user->name,
                'description' => $user->description,
                'type' => $user->type,
                'value' => $user->value,
            ]);
            return back()->with('Success', 'Enumeration added successfully');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if(Session::has('email')){
            $enumeration = Enumeration::find($id);
            return view('enumeration.edit', compact('enumeration'));
        }else{
            return back();
        }
    }

    // delete
    public function delete($id)
    {
        try{
            Enumeration::find($id)->delete();
            return back()->with('Success', 'Enumeration deleted successfully');
        }catch(\Exception $e){
            return back()->with('Error', $e->getMessage());
        }
    }

}
