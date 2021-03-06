<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4" >
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img src="{{ asset('argon') }}/img/brand/logo-fmsp.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('homepage') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('homepage') }}">
                        <i class="fa fa-home"></i>
                        <span class="nav-link-inner--text">{{ __('Home') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('home') }}">
                        <i class="ni ni-planet"></i>
                        <span class="nav-link-inner--text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                        <i class="ni ni-circle-08"></i>
                        <span class="nav-link-inner--text">{{ __('Register') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                        <i class="ni ni-key-25"></i>
                        <span class="nav-link-inner--text">{{ __('Login') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('manuscript.create') }}">
                        <i class="ni ni-single-02"></i>
                        <span class="nav-link-inner--text">{{ __('Submit an article') }}</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                      
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="img/{{ App::getLocale()}}.png" width="50px" height="20x" id="selected-lang"><span class="caret"></span>
                            </a>

                            
                            <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="lang/en" id="en">English <img src="{{asset('img/en.png')}}" width="50px" height="20x"></a>
                                <a class="dropdown-item" href="lang/fr" id="fr">Francais <img src="{{asset('img/fr.png')}}" width="50px" height="20x"></a>
                               
                              </div>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>