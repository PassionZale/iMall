import Vue from 'vue'
import Resource from 'vue-resource'
import Router from 'vue-router'
import routerMap from './router'
import App from './App.vue'

Vue.use(Router);
Vue.use(Resource);

Vue.config.debug = true;
Vue.http.options.emulateJSON = true;
Vue.http.options.emulateHTTP = true;

// laravel csrf token
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
const router = new Router({
    history: false
});

routerMap(router);

router.start(App, 'body');
