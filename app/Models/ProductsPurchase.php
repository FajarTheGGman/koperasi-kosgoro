<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPurchase extends Model
{
    use HasFactory;
    protected $table = 'products_purchase';
    protected $fillable = [
        'rack_id',
        'status'
    ];

    public function rack(){
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

    public function purchase_request(){
        return $this->belongsTo('App\Models\LaporanPR', 'pr_id');
    }
}
