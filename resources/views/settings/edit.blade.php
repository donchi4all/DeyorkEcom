


@extends('layouts.app')

@section('title')
    Edit Settings
@endsection


@section('body')

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Settings</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none"> Edit #{{ $setting->id}}  Settings</h3>
        </div>
        <section class="panel panel-default">
            <header class="panel-heading">
                Add Settings
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
                {!! Form::model($setting, array('method'=>'PATCH','route' => array('setting.update', $setting->id))) !!}
                 
                  @include('settings.fields')
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