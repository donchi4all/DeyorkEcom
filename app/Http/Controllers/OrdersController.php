<?php

namespace App\Http\Controllers;

use Cart;
use App\Order;
use App\Setting;
use App\Shipping;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::all()->sortByDesc('created_at');
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
       
        // $order  =Order::select('id','order_code','status','quantity')->get();

    
        return view('orders.index')->with( 'orders', $orders );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('orders.create')
        ->with('order_code',$this->generateOrdercodeNumber());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
          $order = new Order;
          $input = $request->all();

         

     $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'state' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|min:10'
       
    ],
        [ 
      'firstname.required' => 'Firstname is Required',
      'lastname.required' => 'Lastname is Required',
      'address.required' => 'Address is Required',
      'state.required' => 'State is Required',
       'email.required'=>'Email is Required',
       'phone_number'=>'Valid Mobile no Required'
        ]);


     //serialize the cart content
      $items=serialize(Cart::content());
      
      //getting shipping info
        $shipping_info =$request->except(['items', 'order_code', 'user_id','billing_info']);
     
        //serialize the shipping_info
        $shipping_info=serialize($shipping_info);

      $order->user_id=auth()->user()->id;
      $order->shipping_info=$shipping_info;
      $order->status='new';
      $order->subtotal=Cart::subtotal();
      $order->total=Cart::total();
      $order->quantity=Cart::instance('default')->count();
      $order->items=$items;
      $order->order_code=$input['order_code'];
    

         if($input['billing_info'] == 1)
        $this->addToShippingTables($request);
       
      
       if($order->save())
        {
             
            Session::flash('message','Order was successfully created');
            Session::flash('m-class','alert-success');
       
            //send Mail
             Cart::destroy();
            return redirect('order');
        }
        else
        {
            Session::flash('message','Data is not saved');
            Session::flash('m-class','alert-danger');
            return redirect('order/create');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $order = Order::find($id);
      $orderProduct =Order::orderProduct($order->id ) ;
      
    //   dd($orderProduct[0]);
        return view('orders.show')
        ->with('orderProduct', $orderProduct)
        ->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $order = Order::find($id);
        $shipping= Order::orderShipping($id);
        return view('orders.edit')
        ->with('shipping',  $shipping)
        ->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);

     
        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('order.index'));
        }

         $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'address' => 'required',
        'state' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|min:10'
       
    ],
        [ 
      'firstname.required' => 'Firstname is Required',
      'lastname.required' => 'Lastname is Required',
      'address.required' => 'Address is Required',
      'state.required' => 'State is Required',
       'email.required'=>'Email is Required',
       'phone_number'=>'Valid Mobile no Required'
        ]);
     $input =$request->all();
       
       //getting shipping info
        $shipping_info =$request->except(['items', 'order_code', 'user_id','status']);
        //serialize the shipping_info
        $shipping_info=serialize($shipping_info);

       $order->shipping_info=$shipping_info;
         $order->status=$input['status'];
     //
        $order->update();

        Flash::success('Order updated successfully.');

        return redirect(route('order.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
         Order::find($id)->delete();

        Session::flash('message','Order was successfully deleted');
        Session::flash('m-class','alert-success');
        return redirect('order');
    }

   
    

    //adding a cart 
    public function add_cart(){
        $tax =Setting::settings()->get('tax');
        Cart::setGlobalTax($tax);
        
        // dd(Cart::total());
        Cart::add([
        ['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 10.00, 'weight' => 550],
        ['id' => '4832k', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00, 'weight' => 550, 'options' => ['size' => 'large']]
        ]);

        Flash::success('Cart added successfully.');

        return redirect(route('order.index'));
    }



//adding  or updating to a billing table
       protected function addToShippingTables($request)
       {

        $shipping =Shipping::where('user_id',auth()->user()->id )->first();
        
        if(empty($shipping)){
    

 $shipping = Shipping::create([
               'user_id' => auth()->user() ? auth()->user()->id : null,
               'firstname' => $request->firstname,
               'lastname' => $request->lastname,
               'email' => $request->email,
               'phone_number' => $request->phone_number,
               'address' => $request->address,
               'state' => $request->state,
             
               
           ]);
 }else{
$shipping->update($request->all());


 }
         
       }


    //load the save data
        public function myformAjax($id)
    {

        $shipping =Shipping::where('user_id',$id)->first();  
        return $shipping;
    }
  
    //load the save data
        public function changeStatus($id,$status)
    {
    
       $order = Order::find($id);

        $order->status=$status;
     //
        $order->update();
        
        //send mail for order change
        return $order;
    }
  
    
   


      //processing order
   public function new(){
         $orders = Order::where('status','new')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','new')->orderBy('created_at','desc')->get();
       
        return view('orders.index')->with( 'orders', $orders );
   }
    
   public function shipped(){
         $orders = Order::where('status','shipped')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','shipped')->orderBy('created_at','desc')->get();
       
       
        return view('orders.index')->with( 'orders', $orders );
   }
   public function delivered(){
       $orders = Order::where('status','delivered')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','delivered')->orderBy('created_at','desc')->get();
       
        return view('orders.index')->with( 'orders', $orders );
   }
    
   public function cancelled(){
         $orders = Order::where('status','cancelled')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','cancelled')->orderBy('created_at','desc')->get();
       
       
        return view('orders.index')->with( 'orders', $orders );
   }
   public function returned(){
        $orders = Order::where('status','returned')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','returned')->orderBy('created_at','desc')->get();
       
       
        return view('orders.index')->with( 'orders', $orders );
   }
   public function invoice(){
        $orders = Order::where('status','delivered')->orderBy('created_at','desc')->get();
        if(Auth::user()->type  == "customer")
        $orders =Order::where('user_id',Auth::user()->id)
        ->where('status','delivered')->orderBy('created_at','desc')->get();
       
       
        return view('orders.index')->with( 'orders', $orders );
   }



protected function generateOrdercodeNumber() {
    $number = mt_rand(1000000000, 9999999999); // better than rand()

    // call the same function if the barcode exists already
    if ($this->ordercodeNumberExists($number)) {
        return generateOrdercodeNumber();
    }

    // otherwise, it's valid and can be used
    return $number;
}

  protected function ordercodeNumberExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return Order::where('order_code',$number)->exists();
}


 public function print($id)
    {
        //
         $order = Order::find($id);
      $orderProduct =Order::orderProduct($order->id ) ;
      
    //   dd($orderProduct[0]);
        return view('orders.print')
        ->with('orderProduct', $orderProduct)
        ->with('order', $order);
    }


    public function tracking($order_code){

    }
}
