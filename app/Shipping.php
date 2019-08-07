<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

 public $table = 'shippings';

  const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    
    public $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'address',
        'state',
        
        
    ];

     public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
