<template>
    <p>所需运费：{{order.freight_amount | transformPrice}}</p>
    <p>商品总价：{{order.commodity_amount | transformPrice}}</p>
    <p>订单编号：{{order.order_number}}</p>
    <p>订单总价：{{order.order_amount | transformPrice}}</p>
</template>

<script>
    import { Indicator } from 'mint-ui';
    export default{
        data(){
            return {
                order:{}
            }
        },
        created(){
            this.fetchOrder();
        },
        methods:{
            fetchOrder: function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/order/'+itemId).then(response=>{
                    Indicator.close();
                    if(response.data.code == 0){
                        vm.$set('order',response.data.message);
                    }else{
                        Toast({
                            message: response.data.message
                        });
                    }
                });
            }
        }
    }
</script>