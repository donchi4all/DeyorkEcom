@extends('layouts.app')

 @section('css')
   <style>
   #loader{
   visibility:hidden;
   }
   </style>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
@endsection
@section('body')

<section class="vbox bg-white">
    <header class="header b-b b-light hidden-print">
        @if (auth()->user()->type =="admin")
       
                        <div class="line line-dashed line-sm pull-in"></div>
                    
                                
                                <div class="col-sm-12 pull-center">
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status','new',  $retVal = $order->status =="new" ? true : false) !!}<i class="fa fa-circle-o fa-1x"></i>New </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'shipped',  $retVal = $order->status =="shipped" ? true : false) !!}<i class="fa fa-circle-o"></i>Shipped </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'delivered',  $retVal = $order->status =="delivered" ? true : false) !!}<i class="fa fa-circle-o"></i>Delivered </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'cancelled',  $retVal = $order->status =="cancelled" ? true : false) !!}<i class="fa fa-circle-o"></i>Cancelled </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'returned',  $retVal = $order->status =="returned" ? true : false) !!}<i class="fa fa-circle-o"></i>Returned </label>
                                </div>
                      
       
                        </div>

                             
        @endif
                 
    </header>
    <section class="scrollable wrapper" id="print">
      
        <div class="well m-t" style="margin-bottom: 50px">
            <div class="row">
                <div class="col-xs-6">
                   
                    <h4>{{ $order->name }}</h4>
                  
                </div>
                <div class="col-xs-6 text-right">
                    <p class="h4">#{{ $order->id }}</p>
                  
                    <p class="m-t m-b">Order date: <strong>{{date('d-m-Y', strtotime($order->created_at))}}</strong><br>
                    Order Code: <strong>#{{$order->order_code}}</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table">
            <thead>
            <tr>
                <th> Name</th>
                <th width="60">QTY</th>
                <th>Price</th>
                <th width="120">TOTAL</th>
            </tr>
            </thead>
            <tbody>
              
         @foreach ($orderProduct as $item)
            <tr>
              
                <td>{{ $item->name}}</td>
                <td>{{ $item->qty}}</td>
                <td>{{ $item->price}}</td>
                <td>{{ $item->total}}</td>
                
                @endforeach
                
            </tr>
            <tr>
                <td colspan="2" class="text-right"><strong>Subtotal</strong></td>
                <td>{{\App\Order::presentPrice($order->subtotal)}}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-right no-border"><strong>VAT Included in Total</strong></td>
                <td>{{ \App\Order::presentPrice($order->total - $order->subtotal)  }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-right no-border"><strong>Total</strong></td>
                <td><strong>{{ \App\Order::presentPrice($order->total)  }}</strong></td>
            </tr>
            </tbody>
        </table>

         <div class="line"></div>

        <div class="row">
             <div class="col-sm-12">
               <div class="line line-dashed line-lg pull-in"></div>
               <div></div>
              

                        <!-- Billing FirstName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('firstname', 'Billing FirstName:') !!}
                            {!! Form::text('firstname', 
                            \App\Order::orderShipping($order->id)->get('firstname')
                          , ['placeholder'=>'Enter Billing FirstName','class' => 'form-control input-lg ','readonly']) !!}
                        
                           
                       </div>

                        <!-- Billing LastName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('lastname', 'Billing LastName:') !!}

                            {!! Form::text('lastname',   \App\Order::orderShipping($order->id)->get('lastname'), ['placeholder'=>'Enter Billing LastName','class' => 'form-control input-lg','readonly']) !!}

                        </div>

                        <!-- Billing Email Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('email', 'Billing Name:') !!}

                            {!! Form::text('email',   \App\Order::orderShipping($order->id)->get('email'), ['placeholder'=>'Enter Billing Email','class' => 'form-control input-lg','readonly']) !!}

                        </div>

                        <!-- Billing Address Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('address', 'Billing Address:') !!}
                            {!! Form::text('address',   \App\Order::orderShipping($order->id)->get('address'), ['placeholder'=>'Enter Billing Address','class' => 'form-control input-lg','readonly']) !!}
                        </div>

                        <!-- Billing City Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('state', 'Billing State:') !!}
                            {!! Form::text('state',   \App\Order::orderShipping($order->id)->get('state'), ['placeholder'=>'Enter Billing State','class' => 'form-control input-lg','readonly']) !!}
                        </div>

                       
                        <!-- Billing Phone Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('phone_number', 'Billing Phone:') !!}
                            {!! Form::text('phone_number',   \App\Order::orderShipping($order->id)->get('phone_number'), ['placeholder'=>'Enter Billing Phone Number','class' => 'form-control input-lg','readonly']) !!}
                        </div>

                       

            </div>
        </div>
          <div class="line"></div>
    </section>
</section>

@endsection


@section('scripts')
  
 <script type="text/javascript">
	$(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).prop("checked") == true){

                 var status = $(this).val();
                  var id={{$order->id}}
                 $.ajax({
                url:  '/order/status/'+id+'/'+status,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                  
                },

                success:function(data) {

                 
               
                },
                complete: function(){
                  
                }
            });
                                    
            }
            else if($(this).prop("checked") == false){
               
                
            }
        });
    });
</script>
@endsection