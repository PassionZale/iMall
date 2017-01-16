<template>
    <mt-navbar class="order-list-nav" :selected.sync="order_type" :fixed="true">
        <mt-tab-item id="all" v-link="{name:'order-list',params:{'type':'all'}}">全部订单</mt-tab-item>
        <mt-tab-item id="unpay" v-link="{name:'order-list',params:{'type':'unpay'}}">待付款</mt-tab-item>
        <mt-tab-item id="unreceived" v-link="{name:'order-list',params:{'type':'unreceived'}}">待收货</mt-tab-item>
    </mt-navbar>
    <div id="order-list-part">
        <ul
            v-infinite-scroll="loadMore"
            infinite-scroll-disabled="loading"
            infinite-scroll-distance="5">
            <li v-for="item in list">{{ item }}</li>
        </ul>
    </div>
    <!--<div style="width:100%;text-align:center;color:red;" v-show="loading">加载中...</div>-->
</template>
<style scoped>
.order-list-nav > .mint-tab-item.is-selected{
  color: #09bb07;
  border-bottom: 3px solid #09bb07;
}
.mint-tab-item {
  color: #333;
  text-decoration: none;
}
#order-list-part{
    margin-top:60px;
}
li, ul {
  list-style: none;
  margin:0;
}
li {
    background:#fff;
    height: 200px;
    margin-bottom: 20px;
    border: 1px solid #eee;
}
</style>
<script>
    import { Navbar, TabItem } from 'mint-ui';
    export default{
        data(){
            return {
                order_type:this.$route.params.type,
                paginate:{},
                orders:[],
                loading:false,
                list:[1,2,3,4,5]
            }
        },
        components:{
            Navbar,TabItem
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
                if(!order_type){
                    order_type = vm.$route.params.type;
                }
                vm.$http.get('/api/orderlist/'+order_type).then(response=>{
                    vm.$set('paginate',response.data.message);
                    vm.$set('orders',response.data.message.data);
                });
            },
            loadPageData:function(){
                let vm = this;
                let page = vm.paginate.current_page + 1;
                if(vm.paginate.current_page <= vm.paginate.last_page){
                    vm.$set('loading',true);
                    vm.$http.get('/api/orderlist/'+vm.order_type+'?page='+page).then(response=>{
                        vm.$set('paginate',response.data.message);
                        vm.orders = vm.orders.concat(response.data.message.data);
                        vm.$set('loading',false);
                    });
                }else{
                    console.log('已经到底了！');
                }
            },
            loadMore() {
                  this.loading = true;
                  setTimeout(() => {
                    let last = this.list[this.list.length - 1];
                    for (let i = 1; i <= 10; i++) {
                      this.list.push(last + i);
                    }
                    this.loading = false;
                  }, 2500);
                }
        }
    }
</script>