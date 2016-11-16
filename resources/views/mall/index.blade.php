<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>iMall</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Zhang Lei">
    <meta name="description" content="微信商城：iMall,基于Laravel5.2和vue.js">
    <meta name="keywords" content="微信商城,laravel5.2,vue.js,vuex,vue-router,vue-resource">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('favicon.png')}}" mce_href="{{asset('favicon.png')}}" type="image/png">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" mce_href="{{asset('favicon.ico')}}" type=”image/x-icon”>

    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Styles -->
    <link href="{{asset('css/mall.css')}}" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="{{ asset('js/lib/jquery/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/mall/app.js') }}"></script>

</head>
<body>

</body>
</html>
