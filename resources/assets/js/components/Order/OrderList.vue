<template>
    <mt-navbar class="order-list-nav" :selected.sync="order_type" :fixed="true">
        <mt-tab-item id="all" v-link="{name:'order-list',params:{'type':'all'}}">全部订单</mt-tab-item>
        <mt-tab-item id="unpay" v-link="{name:'order-list',params:{'type':'unpay'}}">待付款</mt-tab-item>
        <mt-tab-item id="unreceived" v-link="{name:'order-list',params:{'type':'unreceived'}}">待收货</mt-tab-item>
    </mt-navbar>
    <div id="order-list-part" v-data-scroll="loadPageData">
        <div class="order-list-container"
             v-for="order in orders"
             v-link="{name:'order-detail',params:{'hashid':order.id}}">
            <div class="order-info">
                <p v-show="order.pay_status === '未支付'"><span class="title">状态：</span>{{order.pay_status}}</p>
                <p v-show="order.pay_status === '已支付'"><span class="title">状态：</span>{{order.ship_status}}</p>
                <p><span class="title">总价：</span>&yen;{{order.order_amount | transformPrice}}</p>
            </div>
            <div class="order-detail" v-for="detail in order.details">
                <img :src="detail.commodity_img" alt="{{detail.commodity_name}}"/>
                <p>{{detail.commodity_name}}</p>
                <p class="title">{{detail.buy_number}}件</p>
            </div>
        </div>
    </div>
    <div id="data-scroll-loading" v-show="isLoading">
        <mt-spinner type="snake" color="#09bb07" :size="15"></mt-spinner>
    </div>
    <div id="data-scroll-end" v-show="isEnd">
        没有更多订单了:)
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
</style>
<script>
    import { Navbar, TabItem, Spinner, Indicator, Toast } from 'mint-ui';
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
            Navbar,TabItem,Spinner,Indicator,Toast
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
                Indicator.open();
                vm.$http.get('/api/orderlist/'+order_type).then(response=>{
                    Indicator.close();
                    if(response.data.message.data.length === 0){
                        Toast({
                              message: '没有符合的订单数据'
                        });
                    }else{
                        vm.$set('paginate',response.data.message);
                        vm.$set('orders',response.data.message.data);
                    }
                });
            },
            loadPageData:function(){
                let vm = this;
                let page = vm.paginate.current_page + 1;
                let triggerDistance = 100;
                let distance = document.querySelector("#order-list-part").getBoundingClientRect().bottom - window.innerHeight;
                if(!vm.isLoading && !vm.isEnd && vm.paginate.data.length && distance < triggerDistance){
                    vm.$set('isLoading',true);
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