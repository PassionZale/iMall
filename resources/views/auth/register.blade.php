<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>iMall | 注册</title>
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

    <link href="{{asset('inspinia/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('css/global.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <h3>Register to iMall</h3>
        <p>Create account to see it in action.</p>
        <form class="m-t" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="用户名" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="邮箱" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="密码" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input name="password_confirmation" type="password" class="form-control" placeholder="确认密码" required>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">注册</button>

            <p class="text-muted text-center"><small>已有账号？</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('/login') }}">登录</a>
        </form>
        <p class="m-t"> <small>iMall base on Laravel 5.2 & Vue.js 1.0 &copy; 2017</small> </p>
    </div>
</div>

<script src="{{asset('inspinia/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('inspinia/js/bootstrap.min.js')}}"></script>
</body>

</html>
