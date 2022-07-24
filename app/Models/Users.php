<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public $timestamps = false;
    public $fillable = [
        'email',
        'fullname',
        'password',
        'picture',
        'role_id'
    ];

    public function roles(){
        return $this->belongsTo('App\Models\Roles', 'role_id');
    }
}
