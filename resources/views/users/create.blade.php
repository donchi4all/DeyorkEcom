

@extends('layouts.app')

@section('title')
    Add Order
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
                {!! Form::open(array('route'=>'user.store')) !!}
              
                  

                <div class="row  col-sm-12"> 

                @if (Auth::user()->type =="admin")
                <!-- Type Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('type', 'Users Type:') !!}
                                {!! Form::select('type', array(  ''  ,'admin' => 'Admin', 'accountant' => 'Accountant', 'sales' => 'Sales','reception'=>'Reception','customer'=>'Customer'), 'S', ['class'=>'form-control m-b input-lg','required']) !!}
                        
                </div>
                @endif
                <!-- Name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
                </div>


  
          
                <!-- Email Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control input-lg']) !!}
                </div>
           </div>
        <div class="row  col-sm-12">
                <!-- Password Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class' => 'form-control input-lg']) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('password-confirm', 'Confirm Password:') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control input-lg']) !!}
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