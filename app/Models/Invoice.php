<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    public $timestamps = false;

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cart(){
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }
}
