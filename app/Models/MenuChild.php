<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuChild extends Model
{
    use HasFactory;
    protected $table = 'menu_child';
    public $timestamps = false;

    public function menu_parent(){
        return $this->belongsTo('App\Models\MenuParent', 'menu_parent_id');
    }
}
