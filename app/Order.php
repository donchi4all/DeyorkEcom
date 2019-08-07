<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     public $table = 'orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


        public $fillable = [
        'user_id',
        'order_code',
        'items',
        'shipping_info',
        'status',
        'quantity'
    ];

     public function user()
    {
        return $this->belongsTo(\App\User::class);
    }


    public static function orderProduct($order_id){
        $order =Order::where('id', $order_id)->first();
    $order =unserialize($order->items);
        
    return $order;
    }
    


    public static function orderShipping($order_id){
        $order =Order::where('id', $order_id)->first();
    $order =unserialize($order->shipping_info);

    $order=(object) $order;
    

      return collect([
            'firstname' =>  $order->firstname,
            'lastname' => $order->lastname,
            'email' => $order->email,
            'address' => $order->address,
            'state' => $order->state,
            'phone_number' => $order->phone_number,
        ]);
  
    }

    public static function presentPrice($price)
    {
    
        return '₦'.number_format($price,2 );
    }

   
}
