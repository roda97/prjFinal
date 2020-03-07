<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CIIC - Computer Science and Communication Research Centre</title>
    <!--<img width="200" height="42"
  src="https://sites.ipleiria.pt/ciic/files/2018/09/cropped-CIIC_BrancoEN-2.png"
  class="custom-logo" alt="CIIC" itemprop="logo">
  srcset="https://sites.ipleiria.pt/ciic/files/2018/09/cropped-CIIC_BrancoEN-2.png 200w,
   https://sites.ipleiria.pt/ciic/files/2018/09/cropped-CIIC_BrancoEN-2-100x21.png 100w"
   sizes="(max-width: 200px) 100vw, 200px"> -->

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
                <img width="50" height="50" src="../img/logo.png" alt="CIIC">

            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#mission">Mission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#awards">Awards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#labs">Laboratories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./#news">News</a>
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
                            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
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
                <div class="intro-lead-in">PROJECTS</div>
                <h1>Projects elaborated throughout the years</h1>
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
                <h2 class="section-heading text-uppercase">Projects</h2>
                <h3 class="section-subheading text-muted">Projects elaborated throughout the years</h3>
            </div>
        </div>
        <div class="row">
            @foreach (\App\Project::all() as $project)
            <div class="col-md-4 col-sm-6 portfolio-item" align="middle">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{ $project->id }}">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="img/portfolio/checklist.png" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>{{ $project->title }}</h4>
                    <!--<p class="text-muted">{{ $project->abstract }}</p>-->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@foreach (\App\Project::all() as $project)
<div class="portfolio-modal modal fade" id="portfolioModal{{ $project->id }}" tabindex="-1" role="dialog" aria-hidden="true">

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
                            <h3 class="text-uppercase">{{$project->title}}</h3>
                            <p class="item-intro text-muted" style="font-weight: bold;">-- Projects Info --</p>
                           <!-- <img class="img-fluid d-block mx-auto" src="img/portfolio/project.jpg" alt=""> -->
                            <p>{{$project-> abstract}}</p>
                            <ul class="list-inline">
                                @if($project-> consortium != null)
                                <li><span style="font-weight: bold;"> Consortium: </span>{{ $project-> consortium }} </li>
                                @endif @if($project-> funding != null)
                                <li><span style="font-weight: bold;">Funding: </span>{{$project-> funding}}</li>
                                @endif @if($project-> proponent != null)
                                <li><span style="font-weight: bold;">Proponent: </span>{{$project-> proponent}}</li>
                                @endif @if($project-> total_budget != null)
                                <li><span style="font-weight: bold;">Total budget: </span>{{$project-> total_budget}}€</li>
                                @endif @if($project-> ciic_budget != null)
                                <li><span style="font-weight: bold;">CIIC budget: </span>{{$project-> ciic_budget}}€</li>
                                @endif
                            </ul>
                            <button class="btn btn-dark" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i> Close Project</button>
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

    #mainNav {
        background-color: #212529;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    a.nav-link.js-scroll-trigger:hover {
        background-color: #404347;
        color: white;
    }
    /***************************** FIM NAV BAR *****************************/

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

    .modal-content{
        opacity: 0.95;
    }

    .fas.fa-plus.fa-3x::before{
       content: url("../img/circle_logo.png");
       display: block;
       position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }

    .portfolio-hover{
        background: rgba(61,66,71, 0.85) !important;
    }
</style>
