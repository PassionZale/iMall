import Vue from 'vue'
import Mint from 'mint-ui'
import Resource from 'vue-resource'
import Router from 'vue-router'
import routerMap from './router'
import App from './App.vue'

Vue.use(Mint);
Vue.use(Router);
Vue.use(Resource);

Vue.config.devtools = true;
Vue.http.options.emulateJSON = true;
Vue.http.options.emulateHTTP = true;
Vue.http.interceptors.push({
    response(response) {
        // 判断是否在微信内置浏览器中
        let ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger') {
            // 若response.data为String类型，将其格式化成JSON类型
            if (typeof response.data === "string") {
                response.data = JSON.parse(response.data)
            }
        }
    },
});

// laravel csrf token
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
const router = new Router({
    history: false,
    mode: 'html5'
});

routerMap(router);

router.start(App, 'body');
