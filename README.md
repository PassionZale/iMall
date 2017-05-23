# iMall
基于Laravel5.2，Vue.js1.0的微信商城

喜欢给个star，谢谢！

由于接口测试号粉丝最多100人，可能关注后会出现部分回复接口无法推送的情况，如：
1. 微信无法正确推送"subscribe"事件至服务器；
2. 粉丝扫码关注后，微信给服务器的状态依然为"unsubscribe"；
3. 粉丝在公众号中回复，微信不会讲消息推送至服务器；
4. 公众号无法做出相应的回复反馈给粉丝，如自动回复，欢迎语等。

我会定期清空粉丝，以方便访问。

[iMall Backend](http://imall.lovchun.com "iMall 后台管理首页")

[iMall Frontend](http://imall.lovchun.com/mall "iMall 微信商城首页")

[Laravel Vue Blog](https://github.com/PassionZale/LVBlog "基于Laravel Vue的个人博客")

微信接口测试公众号

![iMall Qrcode](https://wx2.sinaimg.cn/orj360/006OyqbNgy1ffv3slj5n0j30by0by3ys.jpg "iMall Qrcode")

微信商城

![iMall Frontend](http://wx2.sinaimg.cn/mw1024/006OyqbNgy1ffv3wrqw1rg30ad0ije81.gif "iMall Frontend")

后台CMS

![iMall Backend](http://wx1.sinaimg.cn/mw1024/006OyqbNgy1ffv40gllbgj31h50qndgt.jpg "iMall Backend Login")

![iMall Backend](http://wx2.sinaimg.cn/mw1024/006OyqbNgy1ffv40gne8uj31h60qkmxl.jpg "iMall Backend Regist")

![iMall Backend](http://wx4.sinaimg.cn/mw1024/006OyqbNgy1ffv40h4xlkj31h90qodj5.jpg "iMall Backend Dashboard")

![iMall Backend](http://wx2.sinaimg.cn/mw1024/006OyqbNgy1ffv40hcs3bj31h70qlq5c.jpg "iMall Backend Dashboard")

**可以直接注册一个账号进行浏览**

**不需要配置公众号信息，此功能将移除，替换为配置文件**

**iMall 功能陆续开发中，浏览后台请勿删除任何数据**

>由于公众号菜单总是被人改动，我注释掉了公众号菜单路由以及视图中的公众号菜单设置入口
>可以在routes.php、app.blade.php中开启

## 项目说明
1. 后端（API）基于："laravel/framework": "5.2.*"
2. 前端（商城）基于："vue": "^1.0.26"
3. 商城UI基于："mint-ui": "^1.0.2"
4. 后端（CMS）基于："Inspinia Admin Template"
5. 微信SDK采用："overtrue/laravel-wechat": "~3.0"

## 重要提示
1. 本项目仅为学习Laravel&Vue&Wechat API
2. 未对接微信支付（测试接口号无法调起微信支付API）
3. CMS订单模块发货等功能还未开发

## 环境要求
1. PHP≥5.59
2. composer:1.2.1
3. node:v6.2.0
4. npm:3.8.9

## PHP 扩展
1. open_ssl
2. fileinfo

## TODOS
1. 对接微信支付
2. CMS订单管理模块
3. ~~CMS UI 替换为Inspinia~~

## Composer 、NPM配置
``` shell
#启动composer中国镜像服务
composer config -g repo.packagist composer https://packagist.phpcomposer.com
#启动npm淘宝源
npm i -g nrm
nrm ls          #查看所有npm 源
nrm use taobao  #use 你想要的那一个

```

## 安装步骤
### 安装Composer Package
``` shell
git clone https://github.com/PassionZale/iMall.git
cd iMall/
git update-index --assume-unchanged config/wechat.php
cp .env.example .env
#在.env中配置好数据库连接,并且在wechat.php配置你的公众号信息，继续执行以下步骤
composer install
php artisan key:generate
php artisan migrate
```

### 安装NPM Package
``` shell
cd iMall/
npm install
#此时会依赖.npmrc进行安装node-sass等所有package，若要修改为其他源请修改该文件
#编译sass
gulp admin-sass
gulp mall-sass
gulp global-sass
npm run build
```

## 组件开发
开发阶段，我们需要实时编译*.vue，*.sass等文件，想要npm执行多个进程，可以使用concurrently这个工具
``` shell
npm install -g concurrently
concurrently "npm run taskA" "npm run taskB"
```
拿本项目来说，可以这样：
``` shell
concurrently "webpack --watch" "gulp watchsass"
```

>人生不是接力跑，是马拉松，努力会有回报

>加油，年轻没有失败
