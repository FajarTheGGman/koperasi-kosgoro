<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Privileges;
use App\Models\MenuParent;
use App\Models\Notification;

class Acl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $privileges = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->get();
        $menu_parent = MenuParent::all();
        $notification = Notification::orderBy('id', 'desc')->paginate(5);
        View::share('privileges', $privileges);
        View::share('menu_parent', $menu_parent);
        View::share('notif', $notification);


        $check_route = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->get();

        $check_access = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->first()->access;
        $check_write = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->first()->write;
        $check_update = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->first()->update;
        $check_delete = Privileges::with('roles', 'menu')->where('role_id', $request->session()->get('role_id'))->first()->delete;

        if( preg_match('/add/i', $request->route()->getName()) ){
            if( !$check_write ){
                return back()->with('Error', 'Access Denied');
            }
        }

        if( preg_match('/edit/i', $request->route()->getName()) ){
            if( !$check_update ){
                return back()->with('Error', 'Access Denied');
            }
        }

        if( preg_match('/delete/i', $request->route()->getName()) ){
            if( !$check_delete ){
                return back()->with('Error', 'Access Denied');
            }
        }

        foreach( $check_route as $route ){
            if( $request->route()->getName() == $route->menu->route ){
                return $next($request);
            }else{
                return $next($request);
            }
        }
        return $next($request);
    }
}
