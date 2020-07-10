<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
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

    <style>
        #map {
            height: 400px; 
            width: 100%;
        }
    </style>

</head>

<body id="page-top">
    @include('navigation_view')
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <h1 class="banner-grid">Polytechnic Institute of Leiria</h1>
                <h1 class="banner-grid">Computer Science and Communication Research Centre</h1>
                <!-- <br><br><br><br><br><br>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#awards">Começar</a> -->
            </div>
        </div>
    </header>

    <!-- Noticias -->
    <section id="news">
        <div class="container">
            <div class="col-md-12">
                <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                    <!--
               <ol class="carousel-indicators">
                 <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                 <li data-target="#blogCarousel" data-slide-to="1"></li>
               </ol>
               -->
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item active" >
                            <div class="row">
                                @foreach (\App\News::all()->reverse()->take(3) as $new)
                                <div class="col-md-4">
                                    <div class="item-box-blog">
                                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModalNew{{ $new->id }}">
                                            <img class="img-fluid" src="img/news/{{ $new->new_img_path }}" alt="">
                                        </a>
                                        <!--   <div class="item-box-blog-image"> -->
                                        <!--    <figure> <img alt="new" id="img_news" alt="" src="img/news/{{ $new->new_img_path }}"> </figure> -->
                                       <!-- <div class="item-box-blog-date bg-blue-ui white"> <span class="mon">{{ $new->created_at->format('d/m/Y') }}</span> </div>-->
                                        <!--  </div> -->
                                        <div class="item-box-blog-body">
                                            <!--Heading-->
                                            <div class="item-box-blog-heading">
                                                <a tabindex="0">
                                                    <h5>{{ $new->title }}</h5>
                                                </a>
                                            </div>
                                            <div class="item-box-blog-text">
                                                <p>{{ $new->description }}</p>
                                            </div>
                                        </div>
                                        <!--<a href="#" tabindex="0" class="btn btn-dark">Read more</a>-->
                                        <!--Read More Button-->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!--.row-->
                        </div>
                        <!--.item-->
                        <!-- foi aqui -->
                        <!--.item-->
                    </div>
                    <!--.carousel-inner-->
                </div>
                <!--.Carousel-->
            </div>
        </div>
        <div class="card-tools" style="text-align:center">
            <a class="btn btn-dark" href="./newslist">More News</a>
            <!--  <router-link to="/awardslist"><button class="btn btn-dark"> See More </button></router-link>
-->
        </div>
    </section>

    @foreach (\App\News::all() as $new)
    <div class="portfolio-modal modal fade" id="portfolioModalNew{{ $new->id }}" tabindex="-1" role="dialog" aria-hidden="true">

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
                                <h2 class="text-uppercase">{{$new->title}}</h2>
                                <!--
                                <p class="item-intro text-muted" style="font-weight: bold;">News Info</p>
                                -->
                                @if($new->new_img_path != null)
                                <!-- <img class="img-fluid d-block mx-auto" src="img/news/{{ $new->new_img_path }}" alt=""> -->

                                <ul class="list-inline">
                                    <!--
                                    @endif @if($new->title != null)
                                    <li><span style="font-weight: bold;">Title: </span>{{$new->title}}</li>
-->
                                    @endif @if($new->author != null)
                                    <li><span style="font-weight: bold;">Author: </span>{{$new->author}}</li>
                                    @endif @if($new->created_at != null)
                                    <li><span style="font-weight: bold;">Date: </span>{{$new->created_at->format('d/m/Y')}}</li>
                                    @endif @if($new->description != null)
                                    <li><span style="font-weight: bold;">Description: </span>{{ $new->description }} </li>

                                    <!-- News Body Content -->

                                    @endif @if($new->text != null)
                                    <div id="span_text_news">
                                        <li><span style="font-weight: bold;"><!--Text--></span></li>

                                        {!!$new->text!!}
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

    <!-- About us -->

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">What is CIIC</h2>
                    <h3 class="section-subheading text-muted">CIIC – Computer Science and Communication Research Centre</h3> @foreach (\App\About::all()->take(1) as $about)
                    <p class="text-muted">{{ $about->text }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section id="mission">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Mission</h2>
                    <h3 class="section-subheading text-muted">Information and Communications Technologies</h3> @foreach (\App\Mission::all()->take(1) as $mission)
                    <p class="text-muted">{{ $mission->text }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Awards -->
    <section id="awards">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Awards</h2>
                    <h3 class="section-subheading text-muted">Recognitions throughout the years</h3>
                </div>
            </div>
            @foreach (\App\Award::all()->take(3) as $award)
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        @if (($award->id) % 2 == "0")
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img alt="medal" class="rounded-circle img-fluid" src="img/awards/medal.png">
                            </div>
                            @else
                            <li>
                                <div class="timeline-image">
                                    <img alt="medal2" class="rounded-circle img-fluid" src="img/awards/medal.png">
                                </div>
                                @endif
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="subheading">{{ $award->title }}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">{{ $award->description }}</p>
                                    </div>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-tools" style="text-align:center">
            <a class="btn btn-dark" href="./awardslist">More Awards</a>
            <!--  <router-link to="/awardslist"><button class="btn btn-dark"> See More </button></router-link>
-->
        </div>
    </section>

    <section class="bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Projects</h2>
                    <h3 class="section-subheading text-muted">Projects elaborated throughout the years</h3>
                </div>
            </div>
            <div class="row">
                @foreach (\App\Project::all()->reverse()->take(3) as $project)
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link" align="middle" data-toggle="modal" href="#portfolioModal{{ $project->id }}">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img alt="checklist" class="img-fluid" src="img/portfolio/checklist.png" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h5>{{ $project->title }}</h5>
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
                                <!--<img class="img-fluid d-block mx-auto" src="img/portfolio/project.jpg" alt="">-->
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
    <div class="card-tools" style="text-align:center">
        <a class="btn btn-dark" href="./projectslist">More Projects</a>
    </div>
    </section>

    <!-- Labs -->
    <a id="labs">
        <section class="bg-light" id="portfolio">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading text-uppercase">Laboratories</h2>
                        <h3 class="section-subheading text-muted">CIIC advanced facilities</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach (\App\Laboratories::all()->take(3) as $lab)
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModalLab{{ $lab->id }}">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img alt="lab" class="img-fluid" src="img/labs/{{ $lab->lab_img_path }}" alt="">
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
    </a>

    @foreach (\App\Laboratories::all() as $lab)
    <div class="portfolio-modal modal fade" id="portfolioModalLab{{ $lab->id }}" tabindex="-1" role="dialog" aria-hidden="true">

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
                                <img alt="lab2" class="img-fluid d-block mx-auto" src="img/labs/{{ $lab->lab_img_path }}" alt="">
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
    <div class="card-tools" style="text-align:center">
        <a class="btn btn-dark" href="./laboratorieslist">More Laboratories</a>
        <!--  <router-link to="/awardslist"><button class="btn btn-dark"> See More </button></router-link>
-->
    </div>
    </section>

    

    <section id="contacts">
        <div class="container">

            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase contacts">Contacts</h2>
                <h3 class="section-subheading text-muted">How to reach us</h3>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <p class="large text-muted">
                        Computer Science and Communication Research Centre (CIIC)
                        <br> Polytechnic Institute of Leiria
                        <br> Building C – Campus 2
                        <br> Morro do Lena – Alto do Vieiro
                        <br> 2411-901 Leiria
                        <br> Portugal
                        <br> (+351) 244 820 300
                        <br>
                        <br>
                        <span style="font-weight:bold"> CIIC Coordinator:</span>
                        <br> Carlos Manuel Silva Rabadão
                        <br>
                        <a href="mailto:carlos.rabadao@ipleiria.pt">carlos.rabadao@ipleiria.pt</a>
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe title="location" width="700" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=39.73386636140141%2C%20-8.821951746940613&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 350px;
                                width: 700px;
                            }
                            
                            .gmap_canvas {
                                overflow: hidden;
                                background: none!important;
                                height: 350px;
                                width: 700px;
                            }
                        </style>
                    </div>
                </div>
            </div>

    </section>

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
    
    .img-fluid {
        width: 400px;
    }
    
    .portfolio-link {
        height: 70%;
        width: 70%;
    }

    .labs-link {
        height: 70%;
        width: 70%;
    }
    
    #mainNav {
        background-color: white;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .banner-grid {
        background: url("../img/bg_grid.png");
    }
    
    a.nav-link.js-scroll-trigger:hover {
        background-color: white;
        color: white;
    }
    
    #contacts {
        background-color: #212529;
    }
    
    .large.text-muted {
        color: white !important;
    }
    
    .section-heading.text-uppercase.contacts {
        color: white !important;
    }
    /***************************** FIM NAV BAR *****************************/
    #about {
        background-color: #ffffff !important;
    }

    #mission {
        background-color: #ffffff !important;
    }
    
    #awards {
        background-color: #ffffff !important;
    }
    
    #news {
        background-color: #f8f9fa !important;
    }
    
    #labs {
        background-color: #f8f9fa !important;
    }
    
    #img_news {
        max-height: 165px;
        max-width: 280px;
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

    
    .modal-content {
        opacity: 0.95;
    }
    
    .fas.fa-plus.fa-3x::before {
        content: url("../img/circle_logo.png");
        display: block;
        position: absolute;
        /* top: 50%;
        left: 50%;
        margin-right: -50%; */
        transform: translate(-50%, -50%)
    }
    
    .portfolio-hover {
        background: rgba(61, 66, 71, 0.85) !important;
    }

    .labs-hover {
        background: rgba(61, 66, 71, 0.85) !important;
    }
    
    /***************/
    #span_text_news{
        padding: 25px;
    }


    .cta-100 {
        margin-top: 100px;
        padding-left: 8%;
        padding-top: 7%;
    }
    
    .col-md-4 {
        padding-bottom: 20px;
    }
    
    .white {
        color: #fff !important;
    }
    
    .mt {
        float: left;
        margin-top: -20px;
        padding-top: 20px;
    }
    
    .bg-blue-ui {
        background-color: #708198 !important;
    }
    
    figure img {
        width: 300px;
    }
    
    #blogCarousel {
        padding-bottom: 0px;
    }
    
    .blog .carousel-indicators {
        left: 0;
        top: -50px;
        height: 50%;
    }
    /* The colour of the indicators */
    
    .blog .carousel-indicators li {
        background: #708198;
        border-radius: 50%;
        width: 8px;
        height: 8px;
    }
    
    .blog .carousel-indicators .active {
        background: #0fc9af;
    }
    
    .item-carousel-blog-block {
        outline: medium none;
        padding: 15px;
    }
    
    .item-box-blog {
        border: 1px solid #dadada;
        text-align: center;
        z-index: 4;
        padding: 20px;
        box-shadow: 5px 5px 5px #fed136;
    }
    
    .item-box-blog-image {
        position: relative;
    }
    
    .item-box-blog-image figure img {
        width: 100%;
        height: auto;
    }
    
    .item-box-blog-date {
        position: absolute;
        z-index: 5;
        padding: 4px 20px;
        top: -20px;
        right: 8px;
        background-color: #41cb52;
    }
    
    .item-box-blog-date span {
        color: #fff;
        display: block;
        text-align: center;
        line-height: 1.2;
    }
    
    .item-box-blog-date span.mon {
        font-size: 18px;
    }
    
    .item-box-blog-date span.day {
        font-size: 16px;
    }
    
    .item-box-blog-body {
        padding: 10px;
    }
    
    .item-heading-blog a h5 {
        margin: 0;
        line-height: 1;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .item-box-blog-heading a {
        text-decoration: none;
    }
    
    .item-box-blog-data p {
        font-size: 13px;
    }
    
    .item-box-blog-data p i {
        font-size: 12px;
    }
    
    .item-box-blog-text {
        max-height: 100px;
        overflow: hidden;
    }
    
    .mt-10 {
        float: left;
        margin-top: -10px;
        padding-top: 10px;
    }
    
    .btn.bg-blue-ui.white.read {
        cursor: pointer;
        padding: 4px 20px;
        float: left;
        margin-top: 10px;
    }
    
    .btn.bg-blue-ui.white.read:hover {
        box-shadow: 0px 5px 15px inset #4d5f77;
    }
    
    @media only screen and (max-width: 700px) {
        .mapouter {
            display: none;
        }
    }

    .carousel-inner{
        overflow: visible;
    }
    
</style>