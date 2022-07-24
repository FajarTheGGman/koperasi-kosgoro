<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $table = 'purchase_request';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'rack_id',
        'supplyer',
        'total_price',
    ];

    public function rack(){
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

}
