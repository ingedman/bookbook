<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bookbook') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/fontawesome-all.js')}}"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow-sm">
        <div class="container">


            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button class="navbar-toggler border-0 focus-outline-0" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                {{--<span class="navbar-toggler-icon"></span>--}}
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto align-items-md-center">
                    <!-- Authentication Links -->
                    @guest
                    @else
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Feed') }}</a>
                        <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                        <form class="d-flex align-items-center  mt-2 ml-md-4 mt-md-0 border border-primary rounded-pill">
                            <input class="form-control mr-sm-2 my-0 py-1 border-0 bg-transparent focus-outline-0 focus-shadow-0"
                                   name="q" type="text" placeholder="Search" aria-label="Search">
                            <button class="btn mx-2 my-0 my-sm-0 py-1  focus-outline-0 focus-shadow-0" type="submit"><i
                                        class="fas fa-search"></i></button>
                        </form>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto ">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown  ">
                            <button class="btn focus-shadow-0" type="button" id="notificationsDropdown"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i><span class="badge badge-primary badge-pill">2</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right notifications"
                                aria-labelledby="notificationsDropdown">
                                <div class=" d-flex justify-content-between align-items-center px-2"><h4 class="my-2">
                                        Notifications</h4><a href="{{route('notifications')}}" class="btn btn-link">show
                                        all</a>
                                </div>
                                <li class="divider"></li>
                                <div class="notifications-wrapper">
                                    <a class="content" href="#">

                                        <div class="notification-item px-2 py-3 bg-light">
                                            someone commented on you review
                                        </div>
                                    </a>
                                    <a class="content" href="#">
                                        <div class="notification-item px-2 py-3 bg-light">
                                            500 readers liked your comment
                                        </div>
                                    </a>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown ">
                            <button class="btn focus-shadow-0" type="button" id="navbarDropdown" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/man.jpg')}}" alt="profile" width="30" class="rounded-circle "
                                     v-pre>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>


        </div>

    </nav>


    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>

                <div class="col-md-4 hidden-sm-down">
                @yield('aside')
                </div>
            </div>
        </div>

    </main>
</div>
</body>
</html>
