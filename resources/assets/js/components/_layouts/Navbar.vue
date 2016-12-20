<template>
    <div id="nav-hot-fix" v-show="active"></div>
    <mt-tabbar :selected.sync="selected" :fixed="true" v-show="active">
        <mt-tab-item v-link="{name:'index'}" id="index">
            <i slot="icon" class="nav-index"></i>
            首页
        </mt-tab-item>
        <mt-tab-item v-link="{name:'category'}" id="category">
            <i slot="icon" class="nav-category"></i>
            全部产品
        </mt-tab-item>
        <mt-tab-item v-link="{name:'cart'}" id="cart">
            <i slot="icon" class="nav-cart">
                <mt-badge type="error" size="small" v-show="cartCount > 0">{{cartCount}}</mt-badge>
            </i>
            购物车
        </mt-tab-item>
        <mt-tab-item v-link="{name:'usercenter'}" id="usercenter">
            <i slot="icon" class="nav-usercenter"></i>
            账户中心
        </mt-tab-item>
    </mt-tabbar>
</template>

<script>
import { Tabbar, TabItem, Badge } from 'mint-ui';
export default{
    data(){
        return {
            selected:'',
            cartCount:0,
            active:true
        }
    },
    components:{
        Tabbar, TabItem, Badge
    },
    created(){
        this.initRoute();
        this.initCartCount();
    },
    watch:{
        '$route.name':{
            handler:function(val){
                this.routeHandler(val)
            }
        }
    },
    methods:{
        initRoute:function(){
            this.routeHandler(this.$route.name);
        },
        initCartCount:function(){
            let count = localStorage.getItem('cartCount');
            if(count){
                this.$set('cartCount',count);
            }
        },
        routeHandler:function(val){
            let activeRouteNames = ['index','category','usercenter'];
            if(activeRouteNames.indexOf(val) >= 0){
                this.$set('active',true);
            }else{
                this.$set('active',false);
            }
            this.$set('selected',val);
        }
    }
}
</script>
