<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function rack()
    {
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }
}
