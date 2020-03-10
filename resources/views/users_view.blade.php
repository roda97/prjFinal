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
                <img width="200" height="42" src="../img/logo.png" alt="CIIC">

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
                        <a class="nav-link js-scroll-trigger" href="./#portfolio">Projects</a>
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
                        <a class="nav-link js-scroll-trigger" href="#page-top">Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="./teamslist">Teams</a>
                    </li>
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('home') }}">Home</a>
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
    <!--
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">News</div>
                <h1>Read our most recent scientific publications</h1>
            </div>
        </div>
    </header>
-->
    <!-- BODY HERE -->


    <div class="container" id="inicial_table">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Scientifc Committee</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->scientific_committees_id == 1)
                                <tr>
                                    <td>{{$role->user_name}}</td>

                                    @if($role->degree == 'Postgraduate Academic Degree')
                                    <td>PhD</td>

                                    @elseif($role->degree == 'Master of Science')
                                    <td>MSc</td>

                                    @elseif(!$role->degree)
                                    <td>---</td>
                                    @endif

                                </tr>
                                @endif @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>






    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Full Members</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->name == 'Full Member' && $role->user_name != 'Admin')
                                <tr>
                                    <td>{{$role->user_name}}</td>

                                    @if($role->degree == 'Postgraduate Academic Degree')
                                    <td>PhD</td>

                                    @elseif($role->degree == 'Master of Science')
                                    <td>MSc</td>

                                    @elseif(!$role->degree)
                                    <td>---</td>
                                    @endif

                                </tr>
                                @endif @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>






        <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Effective Member</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->name == 'Effective Member' && $role->user_name != 'Admin')
                                <tr>
                                    <td>{{$role->user_name}}</td>

                                    @if($role->degree == 'Postgraduate Academic Degree')
                                    <td>PhD</td>

                                    @elseif($role->degree == 'Master of Science')
                                    <td>MSc</td>

                                    @elseif(!$role->degree)
                                    <td>---</td>
                                    @endif

                                </tr>
                                @endif @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Integrated Member</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->name == 'Integrated Member' && $role->user_name != 'Admin')
                                <tr>
                                    <td>{{$role->user_name}}</td>

                                    @if($role->degree == 'Postgraduate Academic Degree')
                                    <td>PhD</td>

                                    @elseif($role->degree == 'Master of Science')
                                    <td>MSc</td>

                                    @elseif(!$role->degree)
                                    <td>---</td>
                                    @endif

                                </tr>
                                @endif @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">External Member</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->name == 'External Member' && $role->user_name != 'Admin')
                                <tr>
                                    <td>{{$role->user_name}}</td>

                                    @if($role->degree == 'Postgraduate Academic Degree')
                                    <td>PhD</td>

                                    @elseif($role->degree == 'Master of Science')
                                    <td>MSc</td>

                                    @elseif(!$role->degree)
                                    <td>---</td>
                                    @endif

                                </tr>
                                @endif @endforeach

                            </tbody>
                        </table>
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




</body>

</html>

<style>
    /***************************** INICIO NAV BAR *****************************/
    
    .img-fluid {
        width: 400px;
    }
    
    #mainNav {
        background-color: #5caceb;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    
    a.nav-link.js-scroll-trigger:hover {
        background-color: #404347;
        color: white;
    }
    /***************************** FIM NAV BAR *****************************/
    
    .d-flex.justify-content-center {
        padding: 30px;
    }

    #inicial_table{
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
</style>