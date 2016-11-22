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
    <link rel="icon" href="favicon.png" mce_href="favicon.png" type="image/png">
    <link rel="shortcut icon" href="favicon.ico" mce_href="favicon.ico" type=”image/x-icon”>

    <!--[if lte IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--Import FontAwesome-->
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
<nav>
    <div class="nav-wrapper container">
        <a href="#" class="brand-logo">iMall</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
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
</nav>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">登录</span>
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate" autocomplete="false">
                                    <label for="email">邮箱：</label>
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">phonelink_lock</i>
                                    <input id="password" type="password" class="validate" autocomplete="false">
                                    <label for="password">密码：</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#">This is a link</a>
                    <a href="#">This is a link</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/lib/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/lib/materialize/materialize.min.js"></script>
</body>
</html>
