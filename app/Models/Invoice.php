<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'pr_id');
    }
}
