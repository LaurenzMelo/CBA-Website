<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> CBA Website </title>
        <link rel="icon" href="{{ asset('images/BASC LOGO.png') }}" type="image/icon type">
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
                background-color: #FFFFFF !important;
            }
        </style>
    </head>
    <body>
        <div id='app'>
            <!-- Header/Navbar -->
            <nav class="navbar navbar-expand-lg reduce-padding-top pb-4 pt-4 @route('website.processes') nav-light-bg @endif @route('website.forms') nav-light-bg @endif
                @route('website.events') nav-blue-green @endif @route('website.blog') nav-yellow @endif @route('website.know_us') nav-orange @endif  @route('website.directories') nav-red @endif
                @route('website.ind_blog') nav-yellow @endif">
                <a class="navbar-brand" href="{{ route('website.index') }}" style="margin-left:40px"><img src="{{url('images/BASC LOGO.png')}}" height="75" width="75"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" style="border: 2px solid #222222">
                    <span class="navbar-toggler-icon" style="color: #222222"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto font-weight-bold navbar-spacing font-black navbar-fontsize" style="margin-right:40px;">
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black @route('website.events') font-white @endif" href="/index"> HOME </a>
                            @route('website.index') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                        <li class="nav-item dropdown pr-4 pl-4">
                            <a class="nav-link dropdown-toggle font-roboto font-black @route('website.events') font-white @endif" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> FORMS </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/processes">Processes</a>
                                <a class="dropdown-item" href="/forms">Downloadable Forms</a>
                            </div>
                            @route('website.processes') <hr class="active m-auto" style="width: 50%;"> @endif
                            @route('website.forms') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black @route('website.events') font-white @endif" href="/event"> EVENTS </a>
                            @route('website.events') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black @route('website.events') font-white @endif" href="/blog"> BLOG </a>
                            @route('website.blog') <hr class="active m-auto" style="width: 50%;"> @endif
                            @route('website.ind_blog') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                        <li class="nav-item pr-4 pl-4">
                            <a class="nav-link font-roboto font-black @route('website.events') font-white @endif" href="/know_us"> KNOW US</a>
                            @route('website.know_us') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                        <li class="nav-item pl-4">
                            <a class="nav-link font-roboto font-black @route('website.events') font-white @endif" href="/directories"> DIRECTORIES </a>
                            @route('website.directories') <hr class="active m-auto" style="width: 50%;"> @endif
                        </li>
                    </ul>
                </div>
            </nav>

            @yield('content')

            <!-- Footer -->
            <div class="container-fluid p-5" style="background-color: #2B4D59">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 pt-5 pb-5" style="background-color: white; border-left: 10px solid #39998E; padding-left:60px !important; padding-right: 30px !important">
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
