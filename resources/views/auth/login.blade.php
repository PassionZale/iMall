<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>iMall | 登录</title>
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
    <link href="{{asset('inspinia/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('inspinia/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('css/global.css')}}" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-6">
            <h2 class="font-bold">Welcome to iMall</h2>

            <p>
                Login in. To see it in action.
            </p>

            <p>
                If there is any bug or suggestion,
            </p>

            <p>
                please commit your issue @ <a href="https://github.com/PassionZale/iMall/issues" target="_blank">iMall Issues</a>.
            </p>

            <p>
                iMall is still developing ,
            </p>

            <p>
                please do not delete any data after login.
            </p>

            <p>
                The current version of iMall is basic ,
            </p>

            <p>
                more features will be developed...
            </p>

        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="请输入邮箱" value="{{old('email')}}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="请输入密码" required>
                    </div>
                    <div class="form-group">
                        <div class="i-checks">
                            <label>
                                <input type="checkbox" name="remember" checked>
                                &nbsp;记住我
                            </label>
                            @if(count($errors))
                                <small class="text-danger">账号或密码错误！</small>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

                    <p class="text-muted text-center">
                        <small>还没有账号？</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ url('/register') }}">注册账号</a>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Build by <a href="https://github.com/PassionZale/iMall" target="_blank">PassionZale</a>
        </div>
        <div class="col-md-6 text-right">
            <small>© 2016-2017</small>
        </div>
    </div>
</div>
<script src="{{asset('inspinia/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('inspinia/js/bootstrap.min.js')}}"></script>
<script src="{{asset('inspinia/js/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green'
        });
    });
</script>
</body>

</html>
