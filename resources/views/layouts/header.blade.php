<div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                        <i data-feather="maximize"></i>
                    </a></li>
                <li>
                    <form class="form-inline mr-auto">
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
                <span class="badge headerBadge1">
                        6 </span></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                    <div class="dropdown-header">
                        Notifications
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                            </span> <span class="dropdown-item-desc"> Template update is
                                available now! <span class="time">2 Min
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                            </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                                    Sugiharto</b> are now friends <span class="time">10 Hours
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i class="fas
												fa-check"></i>
                            </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                    Hours
                                    Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i class="fas fa-exclamation-triangle"></i>
                            </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                clean it! <span class="time">17 Hours Ago</span>
                            </span>
                        </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                            </span> <span class="dropdown-item-desc"> Welcome to Otika
                                template! <span class="time">Yesterday</span>
                            </span>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <figure class="avatar mr-2 avatar-sm bg-success text-white" data-initial="{{strtoupper(substr(Auth::user()->name,0,2))}}"></figure> <span class="d-sm-none d-lg-inline-block"></span></a>
                <div class="dropdown-menu dropdown-menu-right pullDown">
                    <div class="dropdown-title">Hello {{ Auth::user()->username }}</div>
                    <a href="{{ route('profile')}}" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> {{ __('Profile') }}
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html"> <img alt="image" src="{{ asset('assets/img/logo3.png')}}" class="header-logo" />
                <span class="logo-name"><span class="first-part">DEL</span><span class="second-part">ASKA</span></span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="dropdown">
                    <a href="{{ route('home')}}" class="nav-link"><i data-feather="monitor"></i><span>{{ __('Dashboard') }}</span></a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('referral')}}" class="nav-link"><i data-feather="link"></i><span>{{ __('Invite a Friend')}}</span></a>
                </li>
                @if(Auth::user()->user_type == 1)
                <li class="dropdown">
                    <a href="{{ route('users')}}" class="nav-link"><i data-feather="users"></i><span>{{ __('Users')}}</span></a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('transaction')}}" class="nav-link"><i data-feather="credit-card"></i><span>{{ __('Transactions')}}</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="help-circle"></i><span>{{ __('Trivia Questions')}}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('history')}}">{{ __('Participants')}}</a></li>
                        <li><a class="nav-link" href="{{ route('question.create')}}">{{ __('Create Question')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="video"></i><span>{{ __('Video')}}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('history')}}">{{ __('Play list')}}</a></li>
                        <li><a class="nav-link" href="{{ route('withdraw')}}">{{ __('Upload Video')}}</a></li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="{{ route('team')}}" class="nav-link"><i data-feather="users"></i><span>{{ __('My Team')}}</span></a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('pay_for_client')}}" class="nav-link"><i data-feather="check-square"></i><span>{{ __('Pay For Client')}}</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="credit-card"></i><span>{{ __('Withdrawal')}}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('history')}}">{{ __('History')}}</a></li>
                        <li><a class="nav-link" href="{{ route('withdraw')}}">{{ __('Withdraw')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ route('questions')}}" class="nav-link"><i data-feather="help-circle"></i><span>{{ __('Trivia Questions')}}</span></a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('video')}}" class="nav-link"><i data-feather="video"></i><span>{{ __('Video')}}</span></a>
                </li>
                @endif
                <!-- <li class="dropdown">
                    <a href="#" class="nav-link"><i data-feather="meh"></i><span>{{ __('Meme Creation')}}</span></a>
                </li> -->
            </ul>
        </aside>
    </div>