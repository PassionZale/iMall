<template>
    <mt-navbar class="order-list-part" :selected.sync="order_type">
        <mt-tab-item id="all" v-link="{name:'order-list',params:{'type':'all'}}">全部订单</mt-tab-item>
        <mt-tab-item id="unpay" v-link="{name:'order-list',params:{'type':'unpay'}}">待付款</mt-tab-item>
        <mt-tab-item id="unreceived" v-link="{name:'order-list',params:{'type':'unreceived'}}">待收货</mt-tab-item>
    </mt-navbar>
    <ul
        v-infinite-scroll="loadPageData"
        infinite-scroll-disabled="loading"
        infinite-scroll-distance="5">
        <li v-for="order in order_data" style="height:200px;">
            {{ order.order_number }}
        </li>
    </ul>
</template>
<style scoped>
.order-list-part > .mint-tab-item.is-selected{
    color: #09bb07;
    border-bottom: 3px solid #09bb07;
}
.mint-tab-item {
  color: #333;
  text-decoration: none;
}

</style>
<script>
    import { Navbar, TabItem, InfiniteScroll } from 'mint-ui';
    export default{
        data(){
            return {
                order_type:this.$route.params.type,
                order_data:[],
                page:1,
                loading:false
            }
        },
        components:{
            Navbar,TabItem,InfiniteScroll
        },
        created(){
            this.fetchOrders();
        },
        watch:{
            'order_type':{
                handler:function(type,old_type){
                    this.fetchOrders(type);
                }
            }
        },
        methods:{
            fetchOrders:function(order_type = false){
                let vm = this;
                let type = '';
                if(!order_type){
                    type = vm.$route.params.type;
                }else{
                    type = order_type;
                }
                vm.$http.get('/api/orderlist/'+type).then(response=>{
                    vm.$set('order_data',response.data.message.data);
                    vm.$set('page',response.data.message.last_page);
                });
            },
            loadPageData:function(){
                let vm = this;
                vm.$set('loading',true);
                let next_page = vm.page;
                vm.$http.get('/api/orderlist/'+order_type+'?page='+next_page).then(response=>{
                    vm.order_data = vm.order_data.concat(response.data.message.data);
                     vm.$set('loading',false);
                });
            }
        }
    }
</script>