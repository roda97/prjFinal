<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Main Page') }}</title>-->
    <title>CIIC - Computer Science and Communication Research Centre</title> 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <!-- Bootstrap core CSS -->
     <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <!-- Custom fonts for this template -->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
     <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
     <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
     <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
 
     <!-- Custom styles for this template -->
     <link href="css/agency.css" rel="stylesheet">
 
     <style>
         #map {
             height: 400 px;
             width: 100 %;
         }
     </style>
 
</head>

<body id="page-top">
<div>
@include('navigation_view')
</div>
<header class="masthead">
    <div class="container">
        <div class="intro-text" style="padding-top: 200px;">
            <h1 class="banner-grid">Login</h1>
            <!-- <br><br><br><br><br><br>
    <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#awards">Começar</a> -->
        </div>
    </div>
</header>
<div class="container">
    <div class="row justify-content-center" style="padding-top: 150px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: #fed136;">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

    <!-- Slider -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
<style>
    /***************************** INICIO NAV BAR *****************************/
    .img-fluid{
        width: 400px;
    }
    #mainNav {
        background-color: white;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    a.nav-link.js-scroll-trigger:hover {
        background-color: white;
        color: white;
    }
    /***************************** FIM NAV BAR *****************************/

    #about {
        .section_clear;
    }

    #mission {
        .section_clear;
    }

    #awards {
        .section_clear;
    }

    #news {
        .section-dark;
    }

    #labs {
        .section-dark;
    }

    section {
        padding: 75px;
    }

    .intro-lead-in {
        font-weight: bold;
    }

    .intro-lead-in h1 {
        font-weight: bold;
    }

    .section-dark {
        background-color: #f8f9fa !important;
    }

    .section-clear {
        background-color: #ffffff !important;
    }

    .modal-content {
        opacity: 0.95;
    }

    .fas.fa-plus.fa-3x::before {
        content: url("../img/circle_logo.png");
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }

    .portfolio-hover {
        background: rgba(61, 66, 71, 0.85) !important;
        display: block !important;
        position: absolute !important;

    }

    .banner-grid {
        background: url("../img/bg_grid.png");
    }

    .btn-link{
        color: #fed136;
    }
</style>
