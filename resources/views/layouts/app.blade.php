<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>iMall | 控制台</title>
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
    <link href="{{asset('inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('css/global.css')}}" rel="stylesheet">

</head>
<body>

<div id="wrapper">

    @include('notice.notice')

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="profile-element">
                        <span>
                            <img alt="image" class="img-circle" width="48" height="48"
                                 src="{{asset('images/admin/profile.jpg')}}"/>
                        </span>
                        <a href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold"> {{ Auth::user()->name }}</strong>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        <img alt="image" class="img-circle" width="20" height="20" src="{{asset('favicon.png')}}"/>
                    </div>
                </li>

                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="/">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-label">控制台</span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/order*') ? 'active' : '' }}">
                    <a href="{{url('admin/order')}}">
                        <i class="fa fa-align-justify"></i>
                        <span class="nav-label">订单管理</span>
                    </a>
                </li>

                <li class="{{request()->is('admin/product/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-product-hunt"></i>
                        <span class="nav-label">商品管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{request()->is('admin/product/commodity*') ? 'active' : ''}}">
                            <a href="{{url('admin/product/commodity')}}">商品</a>
                        </li>
                        <li class="{{request()->is('admin/product/topic*') ? 'active' : ''}}">
                            <a href="{{url('admin/product/topic')}}">专题</a>
                        </li>
                        <li class="{{request()->is('admin/product/plate*') ? 'active' : ''}}">
                            <a href="{{url('admin/product/plate')}}">板块</a>
                        </li>
                        <li class="{{request()->is('admin/product/category*') ? 'active' : ''}}">
                            <a href="{{url('admin/product/category')}}">分类</a>
                        </li>
                    </ul>
                </li>

                <li class="{{request()->is('admin/wechat/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-wechat"></i>
                        <span class="nav-label">公众号管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{request()->is('admin/wechat/menu*') ? 'active' : ''}}"><a
                                    href="{{url('admin/wechat/menu')}}">菜单设置</a></li>
                        <li class="{{request()->is('admin/wechat/follow') ? 'active' : ''}}"><a
                                    href="{{url('admin/wechat/follow')}}">粉丝列表</a></li>
                    </ul>
                </li>

                <li class="{{request()->is('admin/shop/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="nav-label">店铺管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{request()->is('admin/shop/config') ? 'active' : ''}}"><a
                                    href="{{url('admin/shop/config')}}">商铺配置</a></li>
                        <li class="{{request()->is('admin/shop/banner*') ? 'active' : ''}}"><a
                                    href="{{url('admin/shop/banner')}}">轮播图</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to iMall Admin Console.</span>
                    </li>
                    <li>
                        <a href="{{url('/logout')}}">
                            <i class="fa fa-sign-out"></i> 注销
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        @yield('content')

        <div class="footer">
            <div class="pull-right">
                <strong>Copyright</strong> iMall &copy; 2016-2017
            </div>
            <div>
                <i class="fa fa-github"></i> <strong>iMall</strong>
                <a href="https://github.com/PassionZale/iMall" target="_blank">参与开发</a>
            </div>
        </div>

    </div>

</div>

<!-- Mainly scripts -->
<script>
    window._TOKEN = {_token: '{{csrf_token()}}'};
    window._PUT_ = {_method: 'PUT'};
    window._DELETE = {_method: 'delete'};
</script>
<script src="{{asset('inspinia/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('inspinia/js/bootstrap.min.js')}}"></script>
<script src="{{asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('inspinia/js/inspinia.js')}}"></script>
@yield('scriptTag')
</body>
</html>
