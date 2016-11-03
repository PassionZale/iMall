<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

    /*
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => env('WECHAT_APPID', 'wxe0c8630c5b3761ef'),         // AppID
    'secret'  => env('WECHAT_SECRET', 'e93abbe556a4aede7ceb0e3b310e5eaf'),     // AppSecret
    'token'   => env('WECHAT_TOKEN', 'iMall'),          // Token
    'aes_key' => env('WECHAT_AES_KEY', ''),                    // EncodingAESKey

    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file'  => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
    ],

    /*
     * OAuth 配置
     *
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
     */
     'oauth' => [
         'scopes'   => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo'))),
         'callback' => env('WECHAT_OAUTH_CALLBACK', ''),
     ],

    /*
     * 微信支付
     */
    // 'payment' => [
    //     'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', 'your-mch-id'),
    //     'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
    //     'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH', 'path/to/your/cert.pem'), // XXX: 绝对路径！！！！
    //     'key_path'           => env('WECHAT_PAYMENT_KEY_PATH', 'path/to/your/key'),      // XXX: 绝对路径！！！！
    //     // 'device_info'     => env('WECHAT_PAYMENT_DEVICE_INFO', ''),
    //     // 'sub_app_id'      => env('WECHAT_PAYMENT_SUB_APP_ID', ''),
    //     // 'sub_merchant_id' => env('WECHAT_PAYMENT_SUB_MERCHANT_ID', ''),
    //     // ...
    // ],

    /*
     * 开发模式下的免授权模拟授权用户资料
     *
     * 当 enable_mock 为 true 则会启用模拟微信授权，用于开发时使用，开发完成请删除或者改为 false 即可
     */
     'enable_mock' => env('WECHAT_ENABLE_MOCK', false),
     'mock_user' => [
         "openid" =>"oE9sjwYunl6rc1SHaJA-0dCTfFuM",
         // 以下字段为 scope 为 snsapi_userinfo 时需要
         "nickname" => "iMall",
         "sex" =>"1",
         "province" =>"广东",
         "city" =>"深圳",
         "country" =>"中国",
         "headimgurl" => "http://wx.qlogo.cn/mmopen/ZibwoBM9icldvXG8VqGkTBHTILZ938qRrUzxuFK84TQqVP8kc4EqChefXyMfPBrdXtLjMnoXeg2qXAhsw1AxibGR5fVzIGCJPEf/0",
     ],
];
