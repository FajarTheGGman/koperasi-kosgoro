<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    use HasFactory;
    protected $table = 'acl_previleges';
    public $timestamps = false;

    public function roles(){
        return $this->belongsTo('App\Models\Roles', 'role_id');
    }

    public function menu(){
        return $this->belongsTo('App\Models\MenuChild', 'menu_id');
    }
}
