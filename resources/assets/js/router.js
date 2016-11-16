export default function (router) {
    router.redirect({
        '*': '/index'
    });

    router.map({
        '/index': {
            name: 'index',
            component:require('./components/Index.vue')
        },
        '/category':{
            name:'category',
            component:require('./components/Category.vue')
        },
        '/cart':{
            name:'cart',
            component:require('./components/Cart.vue')
        },
        'usercenter':{
            name:'usercenter',
            component:require('./components/UserCenter.vue')
        }
    });
}
