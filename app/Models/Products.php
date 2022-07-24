<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    public $fillable = [
        'id',
        'name',
        'quantity',
        'price',
        'type',
        'image',
        'sell_price',
        'barcode',
        'expired_date',
        'total_income',
        'rack_id'
    ];

    public function rack(){
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

}
