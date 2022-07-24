<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use App\Models\Roles;

class UsersController extends Controller
{
    public function index(){
        if(Session::has('email')){
            $data = Users::with('roles')->get();
            $roles = Roles::all();
            return view('masterdata.users', [
                'users' => $data,
                'roles' => $roles
            ]);
        }else{
            return back();
        }
   }

    public function register(Request $user){
        $email = $user->email;
        $password = Hash::make($user->password);
        $role = $user->role_id;
        $check = Users::where('email', $email)->first();
        if($check){
            toast('Email already exists!', 'error');
            return back();
        }else{
            $newUser = new Users;
            $newUser->email = $email;
            $newUser->fullname = $user->fullname;
            $newUser->password = $password;
            $newUser->picture = 'https://avatars.dicebear.com/api/initials/'.$user->fullname.'.png';
            $newUser->role_id = $role;
            $newUser->save();
            toast('User successfully registered!', 'success');
            return back();
        }
    }

    public function delete($id){
        $user = Users::find($id);
        $user->delete();
        toast('User successfully deleted!', 'success');
        return back();
    }
}
