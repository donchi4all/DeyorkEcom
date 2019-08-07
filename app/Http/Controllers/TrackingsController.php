<?php

namespace App\Http\Controllers;

use App\Order;



class TrackingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('tracks.index');
    }

    //load the save data
    public function tracking($order_code)
    {
      $track =Order::where('order_code',$order_code)->first();
      $track->user_id=\App\User::username($track->user_id)  ;
      $track->show = route('order.show',['id'=>$track->id]);
      $track->print = route('order.print',['id'=>$track->id]);
        return $track;
    }
  
}
