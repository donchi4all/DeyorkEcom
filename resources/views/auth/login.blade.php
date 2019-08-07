{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
    <meta charset="utf-8" />
    <title>Login | E-DELYORK</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{ asset ('css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/font.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('css/app.css') }}" type="text/css" />
    <!--[if lt IE 9]>
    <script src="{{ asset ('js/ie/html5shiv.js') }}"></script>
    <script src="{{ asset ('js/ie/respond.min.js') }}"></script>
    <script src="{{ asset ('js/ie/excanvas.js') }}"></script>
    <![endif]-->
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xxl">
        <a class="text-center block" href="index.html" style="color: #fb6b5b; font-weight: 200; font-size: 40px; margin-top: 20px;line-height: 1.0;" data-toggle="fullscreen">DONSOFT
             <br><span style="font-size: 25px; color: rgb(101, 189, 119); font-weight: 900">NIG</span></a>
        <section class="panel panel-default bg-white m-t-lg">
            <header class="panel-heading text-center">
                <strong>Welcome to E-DELYORK</strong>
            </header>

            {!! Form::open(array('class' => 'panel-body wrapper-lg')) !!}

            @if($errors)
                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="form-group">
                <label class="control-label">Email</label>
                {!! Form::email('email','',[ 'placeholder'=>"test@example.com", 'class'=>"form-control input-lg"]) !!}
            </div>
            <div class="form-group">
                <label class="control-label">Password</label>
                {!! Form::password('password',[ 'placeholder'=>"password", 'class'=>"form-control input-lg"]) !!}
            </div>
            {!! Form::submit('Sign in',[ 'class'=>"btn btn-primary"]) !!}
            {!! Form::close() !!}
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder">
        <p>
            <small>Copyright © {{date('Y')}} DONSOFT NIG</small>
        </p>
    </div>
</footer>
<!-- / footer -->

<script src="{{ asset ('js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset ('js/bootstrap.js') }}"></script>
<!-- App -->
<script src="{{ asset ('js/app.js') }}"></script>
<script src="{{ asset ('js/app.plugin.js') }}"></script>
<script src="{{ asset ('js/slimscroll/jquery.slimscroll.min.js') }}"></script>

</body>
</html>
