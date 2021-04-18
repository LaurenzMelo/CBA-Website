<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> CBA Website </title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald&family=Roboto&family=Train+One&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e3a63f713c.js" crossorigin="anonymous"></script>

        <style>
            #app {
                font-family: 'Montserrat', sans-serif;
            }
            body {
                background-color: #FFDC7C !important;
            }
        </style>
    </head>
    <body>
        <div id='app'>
            <!-- Header/Navbar -->
            <nav class="navbar navbar-expand-lg reduce-padding-top pt-4">
                <a class="navbar-brand" href="{{ route('website.index') }}" style="margin-left:40px"><img src="{{url('images/BASC LOGO.png')}}" height="75" width="75"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="border: 2px solid #222222">
                    <span class="navbar-toggler-icon" style="color: #222222"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto font-weight-bold navbar-spacing font-black navbar-fontsize" style="margin-right:40px;">
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black"> HOME </a>
                            <hr class="active m-auto" style="width: 50%;">
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black"> FORMS </a>
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black"> EVENTS </a>
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black" > BLOG </a>
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black"> KNOW US</a>
                        </li>
                        <li class="nav-item pl-4">
                            <a class="nav-link font-roboto font-black"> DIRECTORIES </a>
                        </li>
                    </ul>
                </div>
            </nav>

            @yield('content')

            <!-- Footer -->
            <div class="container-fluid p-5" style="background-color: #2B4D59">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 pt-5 pb-5" style="background-color: white; border-left: 10px solid #39998E; padding-left:60px !important; padding-right: 60px !important">
                            <h5  class="font-weight-bold"> Reach Us At: </h5>
                            <hr class="m-0 hr-10 mb-3">
                            <div class="row font-size-footer">
                                <div class="col-md-6">
                                    <div class="mt-2 mb-2 font-weight-bold">
                                        <a href="https://www.facebook.com/ue.cbasc" class="link-footer"> <i class="fab fa-facebook-f mr-2"></i> ue.cbasc </a>
                                    </div>
                                    <div class="font-weight-bold">
                                        <a href="https://twitter.com/uemnl_cbasc" class="link-footer"> <i class="fab fa-twitter mr-2"></i> @uemnl_cbasc </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2 mb-2 font-weight-bold">
                                        <a href="https://www.instagram.com/uemnl_cbasc" class="link-footer"> <i class="fab fa-instagram mr-2"></i> uemnl_cbasc </a>
                                    </div>
                                    <div class="font-weight-bold" style="color: #2B4D59">
                                        <i class="fas fa-envelope mr-2"></i> uemnl_cbasc@gmail.com
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
