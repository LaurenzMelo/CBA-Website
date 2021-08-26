<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e3a63f713c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <style>
        #app {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if (!Auth::guest())
        <div class="container-liquid">
            <div class="wrapper">
                <nav id="sidebar">
                    <div class="sidebar-header text-center">
                        <img src="{{url('/images/BASC LOGO.png')}}" alt="Image" height="100px" width="100px"><br>
                        <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                    </div>

                    <ul class="list-unstyled components">
                        <li>
                            <a href="{{ route('home') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('announcements') }}">Announcements</a>
                        </li>
                        <li>
                            <a href="{{ route('blogs') }}">Blogs</a>
                        </li>
                        <li>
                            <a href="{{ route('events') }}">Events</a>
                        </li>
                        <li>
                            <a href="{{ route('forms') }}">Forms & Processes</a>
                        </li>
                        <li>
                            <a href="{{ route('newsletter') }}">Newsletter</a>
                        </li>
                        <li>
                            <a href="{{ route('reports') }}">Reports</a>
                        </li>
                    </ul>
                </nav>
                <div id="content" class="col-md-10">
                    <nav class="navbar navbar-expand-lg navbar-light p-0 ml-2">
                        <div class="container-fluid p-2">
                            <button type="button" id="sidebarCollapse" class="btn btn-info text-white">
                                <i class="fas fa-align-left"></i>
                            </button>
                        </div>
                    </nav>
                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endif
</div>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('#content').toggleClass('col-md-10 col-md-12');
        });
    });
</script>
</body>
</html>
