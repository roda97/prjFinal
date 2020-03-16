<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CIIC - Computer Science and Communication Research Centre</title>

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

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="./">
                <img width="200" height="50" src="../img/ciiclogo.png" alt="CIIC">

            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#news">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#mission">Mission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#awards">Awards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#portfolio">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#labs">Laboratories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#contact">Contact</a>
                    </li>
                    <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="./userslist">Members</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="./teamslist">Teams</a>
          </li>
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('login') }}">Login</a>
                        </li>
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <h1 class="banner-grid">Laboratories</h1>
                <h1 class="banner-grid">CIIC advanced facilities</h1>
                <!-- <br><br><br><br><br><br>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#awards">Começar</a> -->
            </div>
        </div>
    </header>

    <!-- BODY HERE -->

    <section class="bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Laboratories</h2>
                    <h3 class="section-subheading text-muted">CIIC advanced facilities</h3>
                </div>
            </div>
            <div class="row">
                @foreach (\App\Laboratories::all() as $lab)
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{ $lab->id }}">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="img/labs/{{ $lab->lab_img_path }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>{{ $lab->name }}</h5>
                        <p class="text-muted">{{ $lab->workgroup }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach (\App\Laboratories::all() as $lab)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $lab->id }}" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2 class="text-uppercase">{{$lab-> name}}</h2>
                                <p class="item-intro text-muted" style="font-weight: bold;">Projects Info</p>
                                @if($lab-> lab_img_path != null)
                                <img class="img-fluid d-block mx-auto" src="img/labs/{{ $lab->lab_img_path }}" alt="">
                                <ul class="list-inline">

                                    @endif @if($lab-> name != null)
                                    <li><span style="font-weight: bold;">Name: </span>{{$lab-> name}}</li>
                                    @endif @if($lab-> laboratoy_real_id != null)
                                    <li><span style="font-weight: bold;"> Lab ID: </span>{{ $lab-> laboratoy_real_id }} </li>
                                    @endif @if($lab-> school_campus_name != null)
                                    <li><span style="font-weight: bold;">Campus: </span>{{$lab-> school_campus_name}}</li>
                                    @endif @if($lab-> number_work_posts != null)
                                    <li><span style="font-weight: bold;">Number of working Posts: </span>{{$lab-> number_work_posts}}</li>
                                    @endif @if($lab-> area_m2 != null)
                                    <li><span style="font-weight: bold;">Area m2: </span>{{$lab-> area_m2}}</li>
                                    @endif @if($lab-> workgroup != null)
                                    <li><span style="font-weight: bold;">Workgroup: </span>{{$lab-> workgroup}}</li>
                                    <!-- News Body content -->
<br>
<br>
@endif @if($lab->text != null)
                                    <li><span style="font-weight: bold;">Text: </span>{{$lab->text}}</li>



















                                    <!-- End news Body content -->
                                    @endif
                                </ul>
                                <button class="btn btn-dark" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i> Close Laboratory</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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

</html>

<style>
    /***************************** INICIO NAV BAR *****************************/
    .img-fluid{
        width: 400px;
    }
    #mainNav {
        background-color: white;
        padding-top: 10px;
        padding-bottom: 10px;
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
</style>
