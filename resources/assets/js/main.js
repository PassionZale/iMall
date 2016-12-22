import Vue from 'vue'
import Mint from 'mint-ui'
import axios from 'axios'
import Router from 'vue-router'
import routerMap from './router'
import App from './App.vue'

Vue.use(Mint);
Vue.use(Router);

/**
 * 价格转换为0.00的浮点数
 */
Vue.filter('transformPrice',function(value){
    return parseFloat(value).toFixed(2);
});

/**
 * 商品详情换行
 */
Vue.filter('rnTransform',function(value){
    if(value){
        return value.replace(/\r\n/g, "<br/>");
    }
});

Vue.config.devtools = true;
Vue.prototype.$http = axios;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const router = new Router({
    history: false,
    mode: 'html5'
});

routerMap(router);

router.start(App, 'body');
