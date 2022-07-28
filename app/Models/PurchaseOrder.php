<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'purchase_order';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'quantity',
        'price',
        'type',
        'image',
        'status',
        'sell_price',
        'rak'
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\LaporanPR', 'pr_id');
    }
}
