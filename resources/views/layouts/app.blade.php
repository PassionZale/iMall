<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>iMall</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Zhang Lei">
    <meta name="description" content="微信商城：iMall,基于Laravel5.2和vue.js">
    <meta name="keywords" content="微信商城,laravel5.2,vue.js,vuex,vue-router,vue-resource">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('favicon.png')}}" mce_href="{{asset('favicon.png')}}" type="image/png">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" mce_href="{{asset('favicon.ico')}}" type=”image/x-icon”>

    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Fonts -->
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/metisMenu/2.5.2/metisMenu.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                iMall
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登录</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>注销</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@include('notice.notice')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <ul class="metismenu" id="menu">
                <li class="metismenu-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="/">
                        <span class="sidebar-nav-item-icon fa fa-dashboard fa-lg"></span>
                        <span class="sidebar-nav-item">控制台</span>
                    </a>
                </li>
                <li class="metismenu-item {{request()->is('admin/wechat/*') ? 'active' : ''}}">
                    <a href="#">
                        <span class="sidebar-nav-item-icon fa fa-wechat fa-lg"></span>
                        <span class="sidebar-nav-item">公众号管理</span>
                        <span class="fa arrow fa-fw"></span>
                    </a>
                    <ul>
                        <li class="{{request()->is('admin/wechat/info') ? 'active' : ''}}">
                            <a href="{{url('admin/wechat/info')}}">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                基本信息
                            </a>
                        </li>
                        <li class="{{request()->is('admin/wechat/menu*') ? 'active' : ''}}">
                            <a href="{{url('admin/wechat/menu')}}">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                菜单设置
                            </a>
                        </li>
                        <li class="{{request()->is('admin/wechat/follow') ? 'active' : ''}}">
                            <a href="{{url('admin/wechat/follow')}}">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                粉丝列表
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="metismenu-item {{request()->is('admin/shop/*') ? 'active' : ''}}">
                    <a href="">
                        <span class="sidebar-nav-item-icon fa fa-shopping-bag fa-lg"></span>
                        <span class="sidebar-nav-item">店铺管理</span>
                        <span class="fa arrow fa-fw"></span>
                    </a>
                    <ul>
                        <li class="{{request()->is('admin/shop/config') ? 'active' : ''}}">
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                商铺配置
                            </a>
                        </li>
                        <li class="{{request()->is('admin/shop/banner*') ? 'active' : ''}}">
                            <a href="{{url('admin/shop/banner')}}">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                轮播图
                            </a>
                        </li>
                        <li class="{{request()->is('admin/shop/partner') ? 'active' : ''}}">
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                合作伙伴
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="metismenu-item">
                    <a href="">
                        <span class="sidebar-nav-item-icon fa fa-product-hunt fa-lg"></span>
                        <span class="sidebar-nav-item">商品管理</span>
                        <span class="fa arrow fa-fw"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                专题
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                分类
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                商品
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="metismenu-item">
                    <a href="">
                        <span class="sidebar-nav-item-icon fa fa-align-justify fa-lg"></span>
                        <span class="sidebar-nav-item">订单管理</span>
                        <span class="fa arrow fa-fw"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                待发货订单
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                待支付订单
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                已发货订单
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                已收货订单
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span class="sidebar-nav-item-icon fa fa-dot-circle-o fa-fw"></span>
                                已关闭订单
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>
</div>

<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="///cdn.bootcss.com/metisMenu/2.5.2/metisMenu.min.js"></script>
<script>
    $('#menu').metisMenu({toggle: false});
</script>
@yield('scriptTag')
</body>
</html>
