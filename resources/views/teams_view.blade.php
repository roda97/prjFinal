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
    @include('navigation_view')

    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Teams</div>
                <h1>Our scientific teams</h1>
            </div>
        </div>
    </header>

    <!-- BODY HERE -->

    <section id="team_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!--<h2 class="section-heading text-uppercase">Teams</h2>-->
                    <!--<h3 class="section-subheading text-muted">Our scientific teams</h3> -->
                    @foreach($teams as $team) @if($team->isActive == '1')
                    <div id="team">
                        <h3>{{$team->title}}</h3>
                        <div id="team_body">
                        <p><b>Keywords: </b>{{$team->keywords}}</p>
                        <p><b>Scientific Domains: </b>{{$team->scientific_domains}}</p>
                        <p><b>Application Domains: </b>{{$team->application_domains}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
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
    #team_section{
        padding: 50px;
    }

    #team{
        padding-top: 5px;
        border-style: solid;
        border-width: 2px;
        margin-bottom: 20px;
    }

    #team_body{
        padding: 30px;
    }
    
    .d-flex.justify-content-center {
        padding: 30px;
    }
    
    #inicial_table {
        padding-top: 100px;
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