 

                <div class="row  col-sm-12"> 

                @if (Auth::user()->type =="admin")
                <!-- Type Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('type', 'Users Type:') !!}
                                {!! Form::select('type', array( 
                                   $user->type ,'admin' => 'Admin', 'accountant' => 'Accountant', 'sales' => 'Sales','reception'=>'Reception','customer'=>'Customer'), 'S', ['class'=>'form-control m-b input-lg','required']) !!}
                        
                </div>
                @else
                <!-- Name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('type', 'User\'s Type:') !!}
                    {!! Form::text('type', null, ['class' => 'form-control input-lg','readonly']) !!}
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