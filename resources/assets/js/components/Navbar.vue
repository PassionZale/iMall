<template>
    <tabbar>
        <tabbar-item selected>
            <img slot="icon" src="/images/icon/nav-index-icon.png">
            <span slot="label">首页</span>
        </tabbar-item>
        <tabbar-item>
            <img slot="icon" src="/images/icon/nav-category-icon.png">
            <span slot="label">全部产品</span>
        </tabbar-item>
        <tabbar-item badge="9">
            <img slot="icon" src="/images/icon/nav-cart-icon.png">
            <span slot="label">购物车</span>
        </tabbar-item>
        <tabbar-item>
            <img slot="icon" src="/images/icon/nav-usercenter-icon.png">
            <span slot="label">账户中心</span>
        </tabbar-item>
    </tabbar>
</template>
<script>
    import Tabbar from 'vux/dist/components/tabbar'
    import TabbarItem from 'vux/dist/components/tabbar-item'
    import Badge from 'vux/dist/components/badge'
    export default{
        data(){
            return{
                navbars:[],
            }
        },
        components:{
            Tabbar, TabbarItem, Badge
        }
    }

</script>
