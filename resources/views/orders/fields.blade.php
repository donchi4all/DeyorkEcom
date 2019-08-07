              
              
              
              @if (auth()->user()->type  == "admin")
              <div class="col-sm-6">
                        <div class="form-group">
                            <label>User ID</label>
                            {!! Form::text('user_id', null, ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required']) !!}
                        </div>

                       
                       
                    </div>
                       @endif
                    <div class="col-sm-6">
                        

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Select Pament Option</label>
                                    {!! Form::select('payment_gateway', array(
                                        $retVal =\Route::current()->getName() == 'order.edit' ? $order->payment_gateway : ''  
                                      
                                        ,'Postpay' => 'Postpay', 'Prepay (Full)' => 'Prepay (full)', 'Prepay (Half)' => 'Prepay (Half)'), 'S', ['class'=>'form-control m-b input-lg','required']) !!}
                                </div>
                            </div> 




                     @if (\Route::current()->getName() != 'order.edit' )

                                                
                             
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    {!! Form::number('billing_total', cartInfo()->get('newTotal'), ['placeholder'=>'', 'class'=>'form-control input-lg','required','readonly']) !!}
                                </div>
                            

                                <div class="form-group">
                                    <label>SubTotal</label>
                                    {!! Form::text('billing_subtotal', cartInfo()->get('newSubtotal'), ['placeholder'=>'Enter User ID', 'class'=>'form-control input-lg','required','readonly']) !!}
                                </div>
                            

                                <div class="form-group">
                                    <label>Tax</label>
                                    {!! Form::text('billing_tax', cartInfo()->get('newTax'), ['placeholder'=>'', 'class'=>'form-control input-lg','required','readonly']) !!}
                                </div>
                                </div>
                    @else
                                 <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Total Amount</label>
                                    {!! Form::number('billing_total', null, ['placeholder'=>'Enter Amount', 'class'=>'form-control input-lg','required']) !!}
                                </div>
                            

                                <div class="form-group">
                                    <label>Tax</label>
                                    {!! Form::text('billing_tax', null, ['placeholder'=>'', 'class'=>'form-control input-lg','required']) !!}
                                </div>
                                </div>

                    @endif

                        </div>
                    </div>


                <div class="col-sm-12">
                <div class="line line-dashed line-lg pull-in"></div>
                <div class="row">
                   <header class="panel-heading">
                       Billing info
                      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
                   </header>

                        @if (checkBillingInfo())
                              <div class="col-md-12">
                                <span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span>
                             <p><input type="checkbox"> Check if you want to user your Previous billing info.</p> 

                            </div>
                        @endif
                          
                           
                           

                        <!-- Billing Email Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_email', 'Billing Email:') !!}
                          @if (\Route::current()->getName() != 'order.edit' )
                                 {!! Form::text('billing_email', 
                            $retVal = auth()->user()->role_id > 3 ? auth()->user()->email : null
                          , ['placeholder'=>'Enter Billing Email','class' => 'form-control input-lg']) !!}
                        
                            @else
                              {!! Form::text('billing_email',null, ['placeholder'=>'Enter Billing Email','class' => 'form-control input-lg']) !!}
                           
                            @endif
                           
                       </div>

                        <!-- Billing Name Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_name', 'Billing Name:') !!}

                            {!! Form::text('billing_name', null, ['class' => 'form-control input-lg']) !!}

                        </div>

                        <!-- Billing Address Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_address', 'Billing Address:') !!}
                            {!! Form::text('billing_address', null, ['class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Billing City Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_city', 'Billing City:') !!}
                            {!! Form::text('billing_city', null, ['class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Cart Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('cart', 'Cart:') !!}
                          
                          {!! Form::textarea('cart', Cart::Content(), ['placeholder'=>'Enter full address', 'class'=>'form-control input-lg','rows'=>'3','required']) !!}
                        {{-- {!! Form::text('cart', null, ['class' => 'form-control']) !!} --}}
                        </div>

                        <!-- Billing Postalcode Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_postalcode', 'Billing Postalcode:') !!}
                            {!! Form::text('billing_postalcode', null, ['class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Billing Phone Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_phone', 'Billing Phone:') !!}
                            {!! Form::text('billing_phone', null, ['class' => 'form-control input-lg']) !!}
                        </div>

                        <!-- Billing Name On Card Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('billing_name_on_card', 'Billing Name On Card:') !!}
                            {!! Form::text('billing_name_on_card', null, ['class' => 'form-control input-lg']) !!}
                        </div>


                        
                     
                         <!-- Status Field -->
                        <div class="form-group col-sm-6">
                             @if (checkBillingInfo())
                            {!! Form::label('billing_info', 'Update Billing Address:') !!}
                              @else
                            {!! Form::label('billing_info', 'Save Billing Address:') !!}
                                   
                            @endif
                            <label class="checkbox-inline">
                                {!! Form::hidden('billing_info', 0) !!}
                                {!! Form::checkbox('billing_info', '1', null) !!} 
                            </label>
                        </div>
                                        </div>

                </div>

 

                @if (auth()->user()->role_id < 3)
                    
         
                    <div class="col-sm-12">
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2">Status</label>
                                <div class="col-sm-10 ">
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Confirm') !!}<i class="fa fa-circle-o fa-1x"></i>Confirm </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Ready') !!}<i class="fa fa-circle-o"></i>Item Ready </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Send') !!}<i class="fa fa-circle-o"></i>Send </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Delivered') !!}<i class="fa fa-circle-o"></i>Delivered </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Returned') !!}<i class="fa fa-circle-o"></i>Returned </label>
                                    <label class="radio-custom col-md-2 input-md">{!! Form::radio('status', 'Cancelled') !!}<i class="fa fa-circle-o"></i>Cancelled </label>
                                </div>
                            </div>
                        </div>
                    </div>

                 @endif