<template>
    <tabbar :index="indexNav">
        <tabbar-item :link="{name:'index'}">
            <span slot="icon" class="nav-index"></span>
            <span slot="label">首页</span>
        </tabbar-item>
        <tabbar-item :link="{name:'category'}">
            <span slot="icon" class="nav-category"></span>
            <span slot="label">全部产品</span>
        </tabbar-item>
        <tabbar-item :badge="cartCount" :link="{name:'cart'}">
            <span slot="icon" class="nav-cart"></span>
            <span slot="label">购物车</span>
        </tabbar-item>
        <tabbar-item :link="{name:'usercenter'}">
            <span slot="icon" class="nav-usercenter"></span>
            <span slot="label">账户中心</span>
        </tabbar-item>
    </tabbar>
</template>

<script>
    import Tabbar from 'vux/dist/components/tabbar'
    import TabbarItem from 'vux/dist/components/tabbar-item'
    export default{
        data(){
            return{
                navbars:[],
                cartCount:'',
                indexNav:''
            }
        },
        components:{
            Tabbar, TabbarItem
        },
        created(){
            this.initRouter();
            this.fetchCart();
        },
        methods:{
            initRouter:function(){
                let routeName = this.$route.name;
                switch(routeName){
                    case 'index':
                        this.indexNav = 0;
                        break;
                    case 'category':
                        this.indexNav = 1;
                        break;
                    case 'cart':
                        this.indexNav = 2;
                        break;
                    case 'usercenter':
                        this.indexNav = 3;
                        break;
                    default:
                        this.indexNav = -1;
                        break;
                }
            },
            fetchCart:function(){
                // 统计购物车，badge需转为字符串
                let count = 6;
                this.cartCount = count.toString();
            }
        }
    }
</script>
