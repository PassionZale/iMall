<template>
    <div id="pay-order-container">
        <div class="order-title">
            <img src="/images/common/wechat_pay.png"/>
        </div>
        <div class="order-content">
            <p>所需运费：<span class="amount">&yen;{{order.freight_amount | transformPrice}}</span></p>
            <p>商品总价：<span class="amount">&yen;{{order.commodity_amount | transformPrice}}</span></p>
            <p>订单总价：<span class="amount">&yen;{{order.order_amount | transformPrice}}</span></p>
        </div>
        <div class="order-pay-btn" :class="{'disabled' : !visible}">
            微信支付
        </div>
    </div>
</template>

<script>
    import { Indicator } from 'mint-ui';
    export default{
        data(){
            return {
                order:{},
                visible:false
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
            },
            wechatPay: function(){

            }
        }
    }
</script>