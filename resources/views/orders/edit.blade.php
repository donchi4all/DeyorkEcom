@extends('layouts.app')

@section('title')
    Edit Order
@endsection


@section('body')

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Workset</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none"> Edit #{{ $order->id}}  Order</h3>
        </div>
        <section class="panel panel-default">
            <header class="panel-heading">
                Add Order
                <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
            </header>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   
            <div class="panel-body">
                {!! Form::model($order, array('method'=>'PATCH','route' => array('order.update', $order->id))) !!}
                 


   
                  <div class="col-sm-6">
                        <div class="form-group">
                            <label>User ID</label>
                            {!! Form::text('user_id', null, ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required','readonly']) !!}
                        </div>
                        <div class="form-group">
                            <label>Order ID</label>
                            {!! Form::text('order_code',null, ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required','readonly']) !!}
                        </div>

                   </div>
                    
                    <div class="col-sm-6">
                    
                         <!-- Cart Field -->
                      
                            {!! Form::label('items', 'Items:') !!}
                          
                          {!! Form::textarea('items', null, ['placeholder'=>'Enter full address', 'class'=>'form-control input-lg','rows'=>'3','required','readonly']) !!}
                   </div>


                <div class="col-sm-12">
                <div class="line line-dashed line-lg pull-in"></div>
                <div class="row">
                   <header class="panel-heading">
                       Billing info
                      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
                   </header>



                        <!-- Billing FirstName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('firstname', 'Billing FirstName:') !!}
                            {!! Form::text('firstname',$shipping->get('firstname')
                          , ['placeholder'=>'Enter Billing FirstName','class' => 'form-control input-lg']) !!}
                        
                           
                       </div>

                        <!-- Billing LastName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('lastname', 'Billing LastName:') !!}

                            {!! Form::text('lastname', $shipping->get('lastname'), ['placeholder'=>'Enter Billing LastName','class' => 'form-control input-lg']) !!}

                        </div>

                        <!-- Billing Email Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('email', 'Billing Name:') !!}

                            {!! Form::text('email', $shipping->get('email'), ['placeholder'=>'Enter Billing Email','class' => 'form-control input-lg']) !!}

                        </div>

                        <!-- Billing Address Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('address', 'Billing Address:') !!}
                            {!! Form::text('address', $shipping->get('address'), ['placeholder'=>'Enter Billing Address','class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Billing City Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('state', 'Billing State:') !!}
                            {!! Form::text('state', $shipping->get('state'), ['placeholder'=>'Enter Billing State','class' => 'form-control input-lg']) !!}
                        </div>

                       
                        <!-- Billing Phone Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('phone_number', 'Billing Phone:') !!}
                            {!! Form::text('phone_number', $shipping->get('phone_number'), ['placeholder'=>'Enter Billing Phone Number','class' => 'form-control input-lg']) !!}
                        </div>

                       </div>

                </div>

  
         
                    <div class="col-sm-12">
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2">Status</label>
                                <div class="col-sm-10 ">
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'new') !!}<i class="fa fa-circle-o fa-1x"></i>New </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'shipped') !!}<i class="fa fa-circle-o"></i>Shipped </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'delivered') !!}<i class="fa fa-circle-o"></i>Delivered </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'cancelled') !!}<i class="fa fa-circle-o"></i>Cancelled </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'returned') !!}<i class="fa fa-circle-o"></i>Returned </label>
                                </div>
                            </div>
                        </div>
                    </div>

     




                    <div class="col-md-12">
                        <div class="line line-dashed line-lg pull-in"></div>
                        {!! Form::submit('Submit', [ 'class'=>'btn btn-default']) !!}
                    </div>
                {!! Form::close() !!}
            </div>

        </section>
    </section>
</section>

@endsection