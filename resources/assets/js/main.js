import Vue from 'vue'
import Mint from 'mint-ui'
import { InfiniteScroll } from 'mint-ui';
import axios from 'axios'
import Router from 'vue-router'
import routerMap from './router'
import App from './App.vue'

Vue.use(Mint);
Vue.use(InfiniteScroll);
Vue.use(Router);

/**
 * 价格转换为0.00的浮点数
 */
Vue.filter('transformPrice',function(value){
    if(value >= 0){
        return parseFloat(value).toFixed(2);
    }
});

/**
 * 商品详情换行
 */
Vue.filter('rnTransform',function(value){
    if(value){
        return value.replace(/\r\n/g, "<br/>");
    }
});
// Vue.directive('data-scroll',function(value){
//     window.addEventListener('scroll', ()=> {
//         let scrollTop = document.body.scrollTop;
//         if(scrollTop + window.innerHeight >= document.body.clientHeight) {
//             let fnc = value;
//             fnc();
//         }
//     });
// });
// Vue.directive('data-scroll',{
//     params: ['method'],
//     bind:function(){
//         let vm = this;
//         window.addEventListener('scroll', ()=> {
//             if(document.body.scrollTop + window.innerHeight >= vm.el.clientHeight){
//                 let func = vm.params.method;
//                 func();
//             }
//         });
//     }
// });

/**
 * 手机号隐私处理
 */
Vue.filter('transformPhone',function(value){
    if(value){
        let phone = value;
        let phone_head = phone.substring(0,3);
        let phone_foot = phone.substr(7,4);
        return phone_head + '****' + phone_foot;
    }
});

Vue.config.devtools = true;
Vue.prototype.$http = axios;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const router = new Router({
    history: false,
    mode:'abstract'
});

routerMap(router);

router.start(App, 'body');
