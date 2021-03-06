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
                        <h5 class="text-center">CIIC Coordinator</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->function == 'CIIC Coordinator' && $role->user_name != 'Admin')
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
                        <h5 class="text-center">CIIC Coordinating Committee</h5>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Degree</th>
                                </tr>

                                @foreach($roles as $role) @if($role->function == 'CIIC Coordinating Committee' && $role->user_name != 'Admin')
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

        <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Full Member</h5>
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
                            <h5 class="text-center">Collaborator Member</h5>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Degree</th>
                                    </tr>
    
                                    @foreach($roles as $role) @if($role->name == 'Collaborator Member' && $role->user_name != 'Admin')
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
        background-color: white;
        padding-top: 0px;
        padding-bottom: 0px;
    }
    
    a.nav-link.js-scroll-trigger:hover {
        background-color: white;
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

    .banner-grid {
        background: url("../img/bg_grid.png");
    }
</style>