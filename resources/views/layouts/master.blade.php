<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link href="{{ mix('css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ mix('css/font-awe.css') }}" rel="stylesheet" type="text/css" />
    <base href="{{ asset('') }}" />
</head>
<!--/head-->
<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href=""><i class="fa fa-phone"></i></a></li>
                                <li><a href=""><i class="fa fa-envelope"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="{{ route('home') }}"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    @lang('master.language.lang')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('change.locale', 'en') }}">@lang('master.language.lang_en')</a>
                                    </li>
                                    <li><a href="{{ route('change.locale', 'vi') }}">@lang('master.language.lang_vi')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-crosshairs"></i>@lang('master.checkout')</a></li>
                                <li>
                                    <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                                        @lang('master.cart')(@if(Session::get('cart')) {{ count(Session::get('cart')) }} @endif)
                                    </a>
                                </li>
                            @if(Auth::check())
                                <li><a href="{{ route('logout') }}"><i class="fa fa-lock"></i>@lang('master.logout')</a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i>@lang('master.login')</a></li>
                            @endif
                                <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i>@lang('master.profile')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->
        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home') }}" class="active">@lang('master.home')</a></li>
                                <li class="dropdown"><a href="">@lang('master.home')<i
                                            class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="">@lang('master.product')</a></li>
                                        <li><a href="">@lang('master.product_details')</a></li>
                                        <li><a href="">@lang('master.checkout')</a></li>
                                        <li><a href="">@lang('master.cart')</a></li>
                                        <li><a href="">@lang('master.login')</a></li>
                                    </ul>
                                </li>
                                <li><a href="">@lang('master.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{ route('home.search') }}" method="POST">
                                {{ csrf_field() }}
                                <input name="search_home" type="text" placeholder="@lang('master.search')" />
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    @yield('content')

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>@lang('master.service')</h2>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>@lang('master.policy')</h2>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>@lang('master.about')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
    <script src="{{ mix('js/all.js')}}"></script>
</body>
</html>
