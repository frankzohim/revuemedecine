<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/logo-fmsp.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-2-800x800.jpg">
                        </span>
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
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                @if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @endif
                @if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"  aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Manuscripts') }}</span>
                    </a>

                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
						    <li class="nav-item">
                                <a class="nav-link" href="{{ route('manuscript.list', ['status' => 'all']) }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manuscript.list', ['status' => 'En cours de traitement']) }}">
                                    {{ __('Processing') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manuscript.list', ['status' => 'En Relecture']) }}">
                                    {{ __('In Review') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manuscript.list', ['status' => 'Soumission']) }}">
                                    {{ __('In Submission') }}
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                 @endif
                @if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-review" data-toggle="collapse" role="button"  aria-expanded="false" aria-controls="navbar-examples">
                        <i class="ni ni-single-copy-04 text-blue" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: blue">{{ __('Review') }}</span>
                    </a>

                    <div class="collapse" id="navbar-review">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('assign', ['type' => 'reviewer']) }}">
                                     {{ __('Assign') }}
                                </a>
                            </li>
                           <li class="nav-item">
                                <a class="nav-link" href="{{ route('reviewer.create') }}">
                                     {{ __('Add') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('review') }}">
                                     {{ __('List') }}
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('reviewer.list') }}">
                                     {{ __('Reviewers') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                 @if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-editor" data-toggle="collapse" role="button"  aria-expanded="false" aria-controls="navbar-examples">
                        <i class="ni ni-single-copy-04 text-blue" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Editors') }}</span>
                    </a>

                    <div class="collapse" id="navbar-editor">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('assign', ['type' => 'editor']) }}">
                                     {{ __('Assign') }}
                                </a>
                            </li>
                           <li class="nav-item">
                                <a class="nav-link" href="{{ route('editor.create') }}">
                                     {{ __('Add') }}
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('editor.list') }}">
                                     {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if(auth()->user()->role_id==4)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('review') }}">
                        <i class="ni ni-ungroup text-blue"></i> {{ __('Manuscrits') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-ungroup text-blue"></i> {{ __('Review') }}
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-ungroup text-blue"></i> {{ __('The Journal') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __("Copyright") }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-key-25 text-info"></i> {{ __('Publish with us') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Guide to authors') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Guide to reviewers') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">{{ __('View Articles') }}</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-spaceship"></i> {{ __('By Volume') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-palette"></i>{{ __('Per year') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-ui-04"></i>{{ __('By category') }} 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-ui-04"></i>{{ __('By Domain') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
