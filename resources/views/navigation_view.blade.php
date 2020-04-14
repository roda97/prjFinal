<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="index.php">
                <img width="400" height="100" src="../img/ciiclogo.png" alt="CIIC">

            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav text-uppercase ml-auto">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                    </li>-->
                    <!--Menu About us-->
                    <li class="nav-item dropdown">
                            <a id="navbarDropdownAbout" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                About us  <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownAbout">
                                <a class="nav-link js-scroll-trigger" href="#about">What is CIIC</a>
                                <a class="nav-link js-scroll-trigger" href="/userslist">{{ __('People') }}</a>
                                <a class="nav-link js-scroll-trigger" href="#mission">{{ __('Mission') }}</a>
                                <!--falta a rota para a seguinte:
                                <a class="dropdown-item" href="#objetives">{{ __('Objetives') }}</a>
                                -->
                                <a class="nav-link js-scroll-trigger" href="#labs">{{ __('Laboratories') }}</a>
                                
                            </div>
                    </li>

                    <!--Menu Research-->
                    <li class="nav-item dropdown">
                            <a id="navbarDropdownResearch" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Research <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownResearch">
                                <a class="nav-link js-scroll-trigger" href="/teamslist">{{ __('Teams') }}</a>
                                <!--falta a rota para a seguinte:
                                <a class="dropdown-item" href="#">{{ __('Outcomes') }}</a>
                                -->
                                <a class="nav-link js-scroll-trigger" href="#portfolio">{{ __('Projects') }}</a>
                            </div>
                    </li>

                    <!--Mission
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#mission">Mission</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
                    </li>

                    <!--Projects
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Projects</a>
                    </li>-->

                    <!--Laboratories
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#labs">Laboratories</a>
                    </li>-->

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contacts">Contact</a>
                    </li>

                    <!--Members
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/userslist">Members</a>
                    </li>-->

                    <!--Teams
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/teamslist">Teams</a>
                    </li>-->

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
</body>
</html>
