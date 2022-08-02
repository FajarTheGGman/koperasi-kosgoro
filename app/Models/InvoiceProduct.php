<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;
    protected $table = 'invoice_products';

    public function rack(){
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function invoice(){
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }
}
