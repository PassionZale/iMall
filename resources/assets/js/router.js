export default function (router) {
    router.redirect({
        '*': '/'
    });

    router.map({
        '/': {
            name: 'index',
            component:require('./components/Swiper.vue')
        }
    });
}
