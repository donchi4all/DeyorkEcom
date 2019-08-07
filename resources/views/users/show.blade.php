
@extends('layouts.app')

@section('title')
    Edit User
@endsection


@section('body')

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">User</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none"> Show #{{ $user->id}}  User</h3>
        </div>
        <section class="panel panel-default">
            <header class="panel-heading">
                Show User
                <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
            </header>

            <div class="panel-body">
               
                       @include('users.show_fields')
                    <div class="col-md-12">
                        <div class="line line-dashed line-lg pull-in"></div>
                      
                        <a href="{!! route('user.index') !!}" class="btn  btn-default">Back</a> 
                    </div>
                
            </div>

        </section>
    </section>
</section>

@endsection