
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CIIC</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Custom styles for this template -->
  <link href="css/agency.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search"
        type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/scientific" class="brand-link">
      <img  src="./img/logo.png" alt="CIIC Logo" >
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <router-link to="/profile">
            <img src="./img/profile/{{Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image">
          </router-link>
        </div>
        <div class="info">
          <router-link to="/profile" class="d-block">{{Auth::user()->name}}</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!--<li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt yellow"></i>
                <p>Dashboard</p>
            </router-link>
            </li>-->

            <li class="nav-item">
            <router-link to="/home" class="nav-link">
                <i class="nav-icon fas fa-home white"></i>
                <p>Home</p>
            </router-link>
            </li>

            <li class="nav-item">
            <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user orange"></i>
                <p>Profile</p>
            </router-link>
            </li>
            
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog green"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <router-link to="/AboutEdit" class="nav-link">
                  <i class="fas fa-align-left"></i>
                  <p>About Us Text Edit</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/missionEdit" class="nav-link">
                  <i class="fas fa-align-left"></i>
                  <p>Mission Text Edit</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/news" class="nav-link">
                  <i class="fas fa-highlighter"></i>
                  <p>News</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/labs" class="nav-link">
                  <i class="fas fa-laptop"></i>
                  <p>Labs</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/users" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/roles" class="nav-link">
                  <i class="fas fa-tag"></i>
                  <p>Roles</p>
                </router-link>
              </li>
              <!--
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-binoculars"></i>
                  <p>Investigadores</p>
                </a>
              </li>-->
              <li class="nav-item">
                <router-link to ="/scientific" class="nav-link">
                  <i class="fas fa-globe"></i>
                  <p>Reunion</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/partners" class="nav-link">
                  <i class="fas fa-handshake"></i>
                  <p>Partners</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/teams" class="nav-link">
                  <i class="fas fa-fist-raised"></i>
                  <p>Teams</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to ="/awards" class="nav-link">
                  <i class="fas fa-medal"></i>
                  <p>Awards</p>
                </router-link>
              </li>
              </ul>
          </li>

            <li class="nav-item has-treeview">

            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tasks blue"></i>
              <p>
                Projects Administration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <router-link to="/projects" class="nav-link">
                  <i class="fas fa-highlighter"></i>
                  <p>Projects List</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/associateResearchers" class="nav-link">
                  <i class="fas fa-binoculars"></i>
                  <p>Associate Researchers</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/associatePartners" class="nav-link">
                  <i class="fas fa-handshake"></i>
                  <p>Associate Partners</p>
                </router-link>
              </li>

            </ul>

              </li> 

              <!--           
              <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-scroll lime"></i>
              <p>
              Patents Administration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <router-link to="/patents" class="nav-link">
                  <i class="fas fa-highlighter"></i>
                  <p>Patents List</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/home" class="nav-link">
                  <i class="fas fa-user-plus"></i>
                  <p>Associate Users</p>
                </router-link>
              </li>

            </ul>
        </li>
        -->           

            <!-- CIENCIA VITAE -->
            <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-address-book yellow"></i>
              <p>
                Ciencia Vitae
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

            <li class="nav-item">
              <router-link to="/cv_outputs" class="nav-link">
                  <i class="fas fa-poll-h"></i>
                  <p>Outputs</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/cv_degrees" class="nav-link">
                  <i class="fas fa-graduation-cap"></i>
                  <p>Degrees</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/cv_person_info" class="nav-link">
                  <i class="fas fa-user"></i>
                  <p>Person Info</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/cv_language_competency" class="nav-link">
                  <i class="fas fa-language"></i>
                  <p>Language Competency</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_mailingadresses" class="nav-link">
                  <i class="fas fa-home"></i>
                  <p>Mailing Addresses</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_phones" class="nav-link">
                  <i class="fas fa-mobile-alt"></i>
                  <p>Phones</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_web" class="nav-link">
                  <i class="fas fa-globe-americas"></i>
                  <p>Web Addresses</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_privileges" class="nav-link">
                  <i class="fas fa-balance-scale"></i>
                  <p>Access Privileges</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_author" class="nav-link">
                  <i class="fas fa-id-card"></i>
                  <p>Author Identifier</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_citation" class="nav-link">
                  <i class="fas fa-bookmark"></i>
                  <p>Citation Names</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_employment" class="nav-link">
                  <i class="fas fa-briefcase"></i>
                  <p>Employment</p>
                </router-link>
              </li>

              <li class="nav-item">
              <router-link to="/cv_groups" class="nav-link">
                  <i class="fas fa-users-cog"></i>
                  <p>Groups</p>
                </router-link>
              </li>

            <!-- END OF CIENCIA VITAE -->
            </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./">
                <i class="nav-icon fas fa-university purple"></i>
                  <p>Return to site</p>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off red"></i>
                        <p>{{ __('Logout') }}</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy;
    <a href="./">CIIC</a>
    </strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script src="js/app.js"></script>
</body>
</html>
