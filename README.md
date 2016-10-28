# iWmall
基于Laravel5.2，Vue.js1.0的微信商城

# Install
> 安装Composer Package
``` shell
git clone https://github.com/PassionZale/iMall.git
cd iMall/
cp .env.example .env
composer update
php artisan key:generate
php artisan make:migration
```

> 安装NPM Package
``` shell
cd iMall/
npm install
gulp copyfiles
gulp mixless
npm run build
```