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

    <!-- gerar codigo -->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>

<body id="page-top">

    <!-- Navigation -->
    @include('navigation_view')
    
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <h1 class="banner-grid">News</h1>
                <h1 class="banner-grid">Read our most recent scientific publications</h1>
                <!-- <br><br><br><br><br><br>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#awards">Começar</a> -->
            </div>
        </div>
    </header>

    <!-- BODY HERE -->

    <section class="bg-light" id="portfolio">
        <div class="container" id="news">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">News</h2>
                    <h3 class="section-subheading text-muted">Read our most recent scientific publications</h3>
                </div>
            </div>
            <div class="row">
                @foreach (\App\News::all() as $article)
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#portfolioModal{{ $article->id }}">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="img/news/{{ $article->new_img_path }}" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>{{ $article->title }}</h5>
                        <p class="text-muted">{{ $article->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @foreach (\App\News::all() as $article)
    <div class="portfolio-modal modal fade" id="portfolioModal{{ $article->id }}" tabindex="-1" role="dialog" aria-hidden="true">

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
                                <h2 class="text-uppercase">{{$article->title}}</h2>
                                <!--
                                <p class="item-intro text-muted" style="font-weight: bold;">News Info</p>
                                -->
                                @if($article->new_img_path != null)
                               <!-- <img class="img-fluid d-block mx-auto" src="img/news/{{ $article->new_img_path }}" alt=""> -->

                                <ul class="list-inline">
                                    <!--
                                    @endif @if($article->title != null)
                                    <li><span style="font-weight: bold;">Title: </span>{{$article->title}}</li>
-->
                                    @endif @if($article->author != null)
                                    <li><span style="font-weight: bold;">Author: </span>{{$article->author}}</li>
                                    @endif @if($article->created_at != null)
                                    <li><span style="font-weight: bold;">Date: </span>{{$article->created_at->format('d/m/Y')}}</li>
                                    @endif @if($article->description != null)
                                    <li><span style="font-weight: bold;">Description: </span>{{ $article->description }} </li>

                                    <!-- News Body Content -->

                                    @endif @if($article->text != null)
                                    <div id="span_text">
                                    <li><span style="font-weight: bold;"><!--Text--></span></li>
                                    

                                   {!!$article->text!!}
                                   </div>
                                    <!-- End of News Body Content -->

                                    @endif
                                </ul>
                                <button class="btn btn-dark" data-dismiss="modal" type="button">
                                    <i class="fas fa-times"></i> Close New</button>
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

    <script type="text/javascript">
        function functionOne(a) {
            alert(String(a))
        };
    </script>

</body>

</html>

<style>
    /***************************** INICIO NAV BAR *****************************/
    
    .img-fluid {
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

    #span_text{
        padding: 25px;
    }
    
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