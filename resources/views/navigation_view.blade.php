
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="/">
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
                            <a style="{{ (request()->is('userslist')) ? 'color:#fed136' : '' }}" id="navbarDropdownAbout" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" >
                                About us  <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownAbout">
                                <a id="item-what" class="nav-link dropdown-item" href="/#about">What is CIIC</a>
                                <a class="nav-link dropdown-item {{ (request()->is('userslist')) ? 'active' : '' }}" href="/userslist">{{ __('People') }}</a>
                                <a id="item-mission" class="nav-link dropdown-item" href="/#mission">{{ __('Mission') }}</a>
                                <!--falta a rota para a seguinte:
                                <a class="dropdown-item" href="#objetives">{{ __('Objetives') }}</a>
                                -->
                                <a id="item-labs" class="nav-link dropdown-item" href="/#labs">{{ __('Laboratories') }}</a>
                                
                            </div>
                    </li>

                    <!--Menu Research-->
                    <li class="nav-item dropdown">
                            <a style="{{ (request()->is('teamslist')) ? 'color:#fed136' : '' }}" id="navbarDropdownResearch" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Research <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownResearch">
                                <a class="nav-link dropdown-item {{ (request()->is('teamslist')) ? 'active' : '' }}" href="/teamslist">{{ __('Teams') }}</a>
                                <!--falta a rota para a seguinte:
                                <a class="dropdown-item" href="#">{{ __('Outcomes') }}</a>
                                -->
                                <a id="item-portfolio" class="nav-link dropdown-item" href="/#portfolio">{{ __('Projects') }}</a>
                            </div>
                    </li>

                    <!--Mission
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#mission">Mission</a>
                    </li>
                   
                    
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="/#awards">Awards</a>
                    </li>-->

                    <li class="nav-item">
                            <a id="item-awards" class="nav-link js-scroll-trigger"
                            href="{{ url('/#awards') }}">Awards</a> 
                    </li>
                    
<!--
                        <li class="nav-item ">
                            <a class="{{ (request()->is('/#awards')) ? 'nav-link' : '' }}"
                            href="{{ url('/#awards') }}">Awards</a> 
                        </li>
-->

                    <!--Projects
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Projects</a>
                    </li>-->

                    <!--Laboratories
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#labs">Laboratories</a>
                    </li>-->





                  
                    <li class="nav-item">  
                        <a id="item-contacts" class="nav-link js-scroll-trigger" href="/#contacts">Contact</a>
                    </li>
  <!--
                    <li class="nav-item">  
                        <li class="nav-link js-scroll-trigger {% ifequal request.get_full_path '/#contacts' %}active{% endifequal %}" >
                        <a href="/#contacts">Contact</a></li>
                    </li>-->

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
    <script   
        src="https://code.jquery.com/jquery-3.5.0.min.js"   
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="   
        crossorigin="anonymous">
    </script>
    <script> 

    $('li a').click(function(){
        $('li a').removeClass("active");
        $('li a').removeAttr('style');
        $(this).addClass('active');
        $(this).parent().parent().children().eq(0).css('color', '#fed136');
    });    
    var name = window.location.href;
    if(name.includes('#awards')){
        $('#item-awards').addClass('active');
    }
    if(name.includes('#portfolio')){
        $('#item-portfolio').addClass('active');
        $('#navbarDropdownResearch').css('color', '#fed136');  
    }
    if(name.includes('#contacts')){
        $('#item-contacts').addClass('active');
    }
    if(name.includes('#about')){
        $('#item-what').addClass('active');
        $('#navbarDropdownAbout').css('color', '#fed136');
    }
    if(name.includes('#labs')){
        $('#item-labs').addClass('active');
        $('#navbarDropdownAbout').css('color', '#fed136');
    }
    if(name.includes('#mission')){
        $('#item-mission').addClass('active');
        $('#navbarDropdownAbout').css('color', '#fed136');
    }
    </script>






