<template>
    <mt-navbar class="order-list-nav" :selected.sync="order_type" :fixed="true">
        <mt-tab-item id="all" v-link="{name:'order-list',params:{'type':'all'}}">全部订单</mt-tab-item>
        <mt-tab-item id="unpay" v-link="{name:'order-list',params:{'type':'unpay'}}">待付款</mt-tab-item>
        <mt-tab-item id="unreceived" v-link="{name:'order-list',params:{'type':'unreceived'}}">待收货</mt-tab-item>
    </mt-navbar>
    <div id="order-list-part" v-data-scroll="loadPageData">
        <ul>
            <li v-for="order in orders">{{order.id}} - {{ order.order_number }}</li>
        </ul>
    </div>
    <div style="width:100%;text-align:center;color:red;" v-show="isLoading">
        加载中...
    </div>
    <div style="width:100%;text-align:center;color:red;" v-show="isEnd">
        别拉了，已经到底了！
    </div>
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
    height: 350px;
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
                isLoading:false,
                isEnd:false,
            }
        },
        components:{
            Navbar,TabItem
        },
        created(){
            this.fetchOrders();
        },
        route:{
            canReuse:false
        },
        methods:{
            fetchOrders:function(){
                let vm = this;
                let order_type = vm.$route.params.type;
                vm.$http.get('/api/orderlist/'+order_type).then(response=>{
                    vm.$set('paginate',response.data.message);
                    vm.$set('orders',response.data.message.data);
                });
            },
            loadPageData:function(){
                let vm = this;
                let page = vm.paginate.current_page + 1;
                let triggerDistance = 100;
                let distance = document.getElementById('order-list-part').getBoundingClientRect().bottom - window.innerHeight;
                if(!vm.isLoading && !vm.isEnd && distance < triggerDistance){
                    vm.$set('isLoading',true);
                    console.log(vm.isLoading);
                    vm.$http.get('/api/orderlist/'+vm.order_type+'?page='+page).then(response=>{
                        if(response.data.message.data.length === 0){
                            vm.$set('isLoading',false);
                            vm.$set('isEnd',true);
                        }else{
                            vm.$set('paginate',response.data.message);
                            vm.orders = vm.orders.concat(response.data.message.data);
                            vm.$set('isLoading',false);
                        }
                    });
                }
            }
        }
    }
</script>