
 

                <div class="row  col-sm-12"> 

                <!-- Name Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name',  $user->name, ['class' => 'form-control input-lg','readonly']) !!}
                </div>

              <!-- Email Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control input-lg','readonly']) !!}
                </div>
           </div>
        <div class="row  col-sm-12">
                <!-- type Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('type', 'User Type:') !!}
                    {!! Form::text('type', $user->type, ['class' => 'form-control input-lg','readonly']) !!}
                </div>

               
 </div>
