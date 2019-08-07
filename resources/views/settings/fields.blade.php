<!-- Cart Vat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cart_vat', 'Cart Vat %:') !!}
    {!! Form::number('cart_vat', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoice Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('invoice_address', 'Invoice Address:') !!}
    {!! Form::text('invoice_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('setting.index') !!}" class="btn btn-default">Cancel</a>
</div>
