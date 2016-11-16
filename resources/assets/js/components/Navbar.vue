<template>
    <tabbar>
        <tabbar-item selected>
            <span slot="icon" class="nav-index"></span>
            <span slot="label">首页</span>
        </tabbar-item>
        <tabbar-item>
            <span slot="icon" class="nav-category"></span>
            <span slot="label">全部产品</span>
        </tabbar-item>
        <tabbar-item badge="9">
            <span slot="icon" class="nav-cart"></span>
            <span slot="label">购物车</span>
        </tabbar-item>
        <tabbar-item>
            <span slot="icon" class="nav-usercenter"></span>
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
