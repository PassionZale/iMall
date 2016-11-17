<template>
    <mt-tabbar :selected.sync="selected" :fixed="true">
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
            cartCount:0
        }
    },
    components:{
        Tabbar, TabItem, Badge
    },
    ready(){
        this.initRoute();
        this.initCartCount();
    },
    methods:{
        initRoute:function(){
            this.$set('selected',this.$route.name);
        },
        initCartCount:function(){
            let count = localStorage.getItem('cartCount');
            if(count){
                this.$set('cartCount',count);
            }
        }
    }
}
</script>