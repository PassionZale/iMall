export default function (router) {
    router.redirect({
        '*': '/index'
    });

    router.map({
        '/index': {
            name: 'index',
            component: require('./components/Index.vue')
        },
        '/category': {
            name: 'category',
            component: require('./components/Category.vue')
        },
        '/:hashid/commodity': {
            name: 'commodity',
            component: require('./components/Commodity/CommodityDetail.vue')
        },
        '/cart': {
            name: 'cart',
            component: require('./components/Cart.vue')
        },
        '/usercenter': {
            name: 'usercenter',
            component: require('./components/UserCenter.vue')
        },
        '/attr': {
            name: 'attribute',
            component: require('./components/Attribute/Attribute.vue'),
            subRoutes: {
                '/:hashid/topic': {
                    name: 'aTopic',
                    component: require('./components/Attribute/Topic.vue')
                },
                '/:hashid/plate': {
                    name: 'aPlate',
                    component: require('./components/Attribute/Plate.vue')
                },
                '/:hashid/category': {
                    name: 'aCategory',
                    component: require('./components/Attribute/Category.vue')
                }
            }
        },
        '/address': {
            name: 'address',
            component: require('./components/Address/AddressList.vue')
        },
        '/add-address': {
            name: 'add-address',
            component: require('./components/Address/AddressAdd.vue')
        },
        '/:hashid/edit-address': {
            name: 'edit-address',
            component: require('./components/Address/AddressEdit.vue')
        },
        '/:hashid/choose-address': {
            name: 'choose-address',
            component: require('./components/Address/AddressChoose.vue')
        },
        '/ordersettle': {
            name: 'order-settle',
            component: require('./components/Order/OrderSettle.vue')
        },
        '/:type/orderlist': {
            name: 'order-list',
            component: require('./components/Order/OrderList.vue')
        },
        '/:hashid/orderdetail': {
            name: 'order-detail',
            component: require('./components/Order/OrderDetail.vue')
        },
        '/:hashid/orderpay': {
            name: 'orderpay',
            component: require('./components/Order/OrderPay.vue')
        },
        '/suggestion': {
            name: "suggestion",
            component: require('./components/Suggestion/Suggestion.vue')
        }
    });
}
