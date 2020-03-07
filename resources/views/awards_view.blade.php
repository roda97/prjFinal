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
            <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
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
        <div class="intro-lead-in">AWARDS</div>
        <h1>Recognitions throughout the years</h1>
       <!-- <br><br><br><br><br><br>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#awards">Começar</a> -->
      </div>
    </div>
  </header>


<!-- BODY HERE -->

<section id="awards">
    <div class="container">
      @foreach (\App\Award::all() as $award)
      <div class="row">
        <div class="col-lg-12"> 
          <ul class="timeline">
              @if (($award->id) % 2 == "0")    
              <li class="timeline-inverted">
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/awards/medal.png">
              </div>                      
              @else             
              <li>
              <div class="timeline-image">
                <img class="rounded-circle img-fluid" src="img/awards/medal.png">
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
  </section>


<!-- END BODY -- >

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

#mainNav{
  background-color: #212529;
  padding-top: 10px;
  padding-bottom: 10px;
}

a.nav-link.js-scroll-trigger:hover{
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

.intro-lead-in{
  font-weight: bold;
}

.intro-lead-in h1{
  font-weight: bold;
}

.section-dark {
  background-color: #f8f9fa !important;
}

.section-clear {
  background-color: #ffffff !important;
}