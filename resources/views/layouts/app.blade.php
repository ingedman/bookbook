<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bookbook') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/cropper.css" rel="stylesheet">
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
                <ul class="navbar-nav mr-auto1 flex-grow-1 align-items-md-center">
                    <!-- Authentication Links -->
                    @guest
                    @else

                        <search-input search_url="{{ route('search.all') }}"
                                      icon_url="{{ asset('images/logo-algolia-nebula-blue-full.svg') }}"

                        ></search-input>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto1 align-items-center ">
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
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Feed') }}</a>
                        <a class="nav-link" href="{{ route('own-profile') }}">{{ __('Profile') }}</a>

                        <li class="nav-item">
                            <a href="{{ route('bookmarks') }}"
                               class="nav-link"
                               data-toggle="tooltip"
                               data-placement="bottom"
                               title="Read Later List"
                            >
                                <i class="far fa-bookmark line-height-initial hidden-sm-down"></i>
                                <span class=" hidden-md-up">Read later list</span>

                            </a>
                        </li>

                        <notifications-drop-down class="" all_url="{{route('notifications')}}"
                                       notifications_url="{{route('notifications.unread',Auth::user()->{'id'}) }}"
                                       user_id="{{ Auth::user()->{'id'} }}"
                                       read_all_url="{{ route('notifications.read_all') }}"
                        ></notifications-drop-down>

                        <li class="nav-item dropdown ">
                            <button class="btn nav-link focus-shadow-0"
                                    type="button"
                                    id="navbarDropdown"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    dusk="navbar-profile-avatar"
                            >

                                <profile-picture src="{{ Auth::user()->{'avatarUrl'} }}"
                                                 width="30"
                                                 class="hidden-sm-down"
                                ></profile-picture>
                                <span class=" hidden-md-up dropdown-toggle">{{ Auth::user()->{'name'} }}</span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right"
                                 aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('followers') }}">
                                    {{ __('Followers') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('following') }}">
                                    {{ __('Following') }}
                                </a>
                                <div class="dropdown-divider"></div>
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
                    @include('partials.modals')

                </div>
                @hasSection('aside')
                    <div class="col-md-4 hidden-sm-down">
                        @yield('aside')
                    </div>
                @endif
            </div>
        </div>

    </main>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>
@stack('scripts')
</body>
</html>
