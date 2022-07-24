<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPurchase extends Model
{
    use HasFactory;
    protected $table = 'products_purchase';

    public function rack(){
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }
}
