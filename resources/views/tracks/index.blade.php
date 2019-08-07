@extends('layouts.app')

@section('title')
    All Orders
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

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Workset</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none">Tracking Order</h3>
        </div>
        <section class="panel panel-default">
     <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

            <header class="panel-heading">
               Track  All Orders Data
                <!-- Track Field -->
                
                    <div class="row ">
                   <div class="col-md-6">
                    {{-- {!! Form::text('track', null, ['placeholder'=>'Enter Order Code','class' => 'form-control input-lg']) !!} --}}
                   <input type="number " placeholder="Enter Order Code" id="track" name="track" class="form-control input-lg">
                   </div>

                   <div class="col-md-6">
                       {!! Form::submit('Tracking', [ 'class'=>'btn btn-info input-lg']) !!}
                   </div>
                    
                    </div>
                

            </header>

 
    
            <div class="table-responsive">
               

 <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>
                            <th width="">Order Code</th>
                            <th width="">Status</th>
                            
                            <th width="">Ordered By</th>
                            <th width="">Total</th>
                            <th width="150px">Buttons</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                            <tr>
                                <td id="order_code"></td>
                                <td id="status"></td>
                                <td id="user"></td>
                                <td id="total"></td>
                                <td id="link">
                                    
                                    {{-- <a href="{{ route('user.show',$order->id) }}" class="btn btn-sm btn-icon btn-success"><i class="fa fa-eye"></i></a> --}}
                                </td>
                            </tr>
                      
                    </tbody>
                </table>

            </div>
        </section>
    </section>
 </section>


@endsection




@section('scripts')
  
 <script type="text/javascript">
	$(document).ready(function(){
        $('input[type="submit"]').click(function(){
          
                 var order_code = document.getElementById("track").value;
                 
                 $.ajax({
                url:  '/tracking/search/'+order_code,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    // $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                console.log("order_code");
                 
                 $("#order_code").html('<td> '+(data["order_code"]) +'</td>');
                 $("#status").html('<td> '+(data["status"]) +'</td>');
                 $("#user").html('<td> ' +( data["user_id"]) +'</td>');
                 $("#total").html('<td> ₦'+(data["total"]) +'</td>');
                 $("#link").html('<td> <a href="'+(data["show"])+'" class="btn btn-sm btn-icon btn-success"><i class="fa fa-eye"></i></a><a href="'+(data["print"])+'" class="btn btn-sm btn-icon btn-info"><i class="fa fa-print"></i></a></td>');
                 
                
                },
                complete: function(){
                    // $('#loader').css("visibility", "hidden");
                }
            });
                                    
          
        });
    });
</script>
@endsection