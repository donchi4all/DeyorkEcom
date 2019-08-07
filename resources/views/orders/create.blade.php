@extends('layouts.app')

@section('title')
    Add Order
@endsection

 @section('css')
   <style>
   #loader{
   visibility:hidden;
   }
   </style>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
@endsection

@section('body')

 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


</table>
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Workset</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none">Add a Order</h3>
        </div>
        <section class="panel panel-default">
            <header class="panel-heading">
                Add Order
                <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
            </header>
 
            <div class="panel-body">
                {!! Form::open(array('route'=>'order.store')) !!}
              


              <div class="col-sm-6">
                        <div class="form-group">
                            {{-- <label>User ID</label> --}}
                            {!! Form::hidden('user_id', auth()->user()->id, ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required','readonly']) !!}
                        </div>
                        <div class="form-group">
                            <label>Order ID</label>
                            {!! Form::text('order_code',$order_code, ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required','readonly']) !!}
                        </div>

                   </div>
                    
                    <div class="col-sm-6">
                    
                         <!-- Cart Field -->
                      
                            {!! Form::label('items', 'Items:') !!}
                          
                          {!! Form::textarea('items', Cart::Content(), ['placeholder'=>'Enter full address', 'class'=>'form-control input-lg','rows'=>'3','required','readonly']) !!}
                   </div>


                <div class="col-sm-12">
                <div class="line line-dashed line-lg pull-in"></div>
                <div class="row">
                   <header class="panel-heading">
                       Billing info
                      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
                   </header>

                      @if ( \App\Shipping::where('user_id',auth()->id())->first() != null  )
                     
                              <div class="col-md-12">
                                <span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span>
                             <p><input type="checkbox"> Check if you want to user your Previous billing info.</p> 

                            </div>
                            
                      @endif
                          
                           
                           

                        <!-- Billing FirstName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('firstname', 'Billing FirstName:') !!}
                            {!! Form::text('firstname', 
                            $retVal = auth()->user()->role_id > 3 ? auth()->user()->email : null
                          , ['placeholder'=>'Enter Billing FirstName','class' => 'form-control input-lg']) !!}
                        
                           
                       </div>

                        <!-- Billing LastName Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('lastname', 'Billing LastName:') !!}

                            {!! Form::text('lastname', null, ['placeholder'=>'Enter Billing LastName','class' => 'form-control input-lg']) !!}

                        </div>

                        <!-- Billing Email Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('email', 'Billing Name:') !!}

                            {!! Form::text('email', null, ['placeholder'=>'Enter Billing Email','class' => 'form-control input-lg']) !!}

                        </div>

                        <!-- Billing Address Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('address', 'Billing Address:') !!}
                            {!! Form::text('address', null, ['placeholder'=>'Enter Billing Address','class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Billing City Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('state', 'Billing State:') !!}
                            {!! Form::text('state', null, ['placeholder'=>'Enter Billing State','class' => 'form-control input-lg']) !!}
                        </div>

                       
                        <!-- Billing Phone Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('phone_number', 'Billing Phone:') !!}
                            {!! Form::text('phone_number', null, ['placeholder'=>'Enter Billing Phone Number','class' => 'form-control input-lg']) !!}
                        </div>

                       


                        
                     
                         <!-- Status Field -->
                        <div class="form-group col-sm-6">
                           {!! Form::label('billing_info', 'Save Billing Address:') !!}
                           <label class="checkbox-inline">
                                {!! Form::hidden('billing_info', 0) !!}
                                {!! Form::checkbox('billing_info', '1', null) !!} 
                            </label>
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


@section('scripts')
  
 <script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){

                 var department_id = {{Auth::user()->id}}
                 
                 $.ajax({
                url:  '/myform/ajax/'+department_id,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                 
                  $("#firstname").val(data["firstname"]);
                  $("#lastname").val(data["lastname"]);
                  $("#email").val(data["email"]);
                  $("#phone_number").val(data["phone_number"]);
                  $("#address").val(data["address"]);
                  $("#state").val(data["state"]);
               
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
                                    
            }
            else if($(this).prop("checked") == false){
                $("#firstname").val("");
                  $("#lastname").val("");
                  $("#email").val("");
                  $("#phone_number").val("");
                  $("#address").val("");
                  $("#state").val("");
                
            }
        });
    });
</script>
@endsection