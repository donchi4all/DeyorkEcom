<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
 public $table = 'settings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'cart_vat',
        'invoice_address'
    ];

    public static function settings(){
         $settings=Setting::first();
           return collect([
            'tax' => $settings->cart_vat,
            'address' => $settings->invoice_address,
        ]);
    }
}
