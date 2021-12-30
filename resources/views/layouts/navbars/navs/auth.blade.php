<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
       
        <a class="h4 mb-0 text-white text-uppercase btn btn-success d-none d-lg-inline-block" href="{{ route('manuscript.create') }}">{{ __('Submit an article') }}</a>
        
        
    
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Search') }}" type="text">
                </div>
            </div>
           
        </form>

        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                      
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src='{{ asset('img/' . App::getLocale() . '.png') }}' width="50px" height="20x" id="selected-lang"><span class="caret"></span>
                            </a>

                            
                            <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('lang', ['locale' => 'en']) }}" id="en">English <img src="{{asset('img/en.png')}}" width="50px" height="20x"></a>
                                <a class="dropdown-item" href="{{ route('lang', ['locale' => 'fr']) }}" id="fr">Francais <img src="{{asset('img/fr.png')}}" width="50px" height="20x"></a>
                               
                              </div>
                        </li>
                        
        </ul>

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-2-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profil') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>