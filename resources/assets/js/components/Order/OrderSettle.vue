<template>
    <div id="to-pay-container" v-show="!choosing">
        <div class="address-wrap">
            <div class="address-default">
                <span>收货地址</span>
                <ul v-show="address != ''"
                    @click="chooseAddress">
                    <li>
                        {{address.province}}{{address.city}}{{address.district}}{{address.address}}
                    </li>
                    <li>
                        {{address.name}} {{address.phone | transformPhone}}
                    </li>
                </ul>
                <ul v-show="address == ''"
                    v-link="{name:'add-address'}">
                    <li>
                        送至...
                    </li>
                    <li>
                        还未新建地址，点击新建
                    </li>
                </ul>
            </div>
        </div>
        <div id="cart-container">
            <section class="cart-wrap" v-for="good in goods">
                <i class="select-one-btn selected">
                </i>
                <a class="img-wrap">
                    <img :src="good.commodity_img"/>
                    <p class="name">{{good.commodity_name}}</p>
                </a>
                <div class="price-wrap">
                    <span class="commodity-result">
                            <span>&yen;{{good.commodity_current_price | transformPrice}}</span> *
                            <span class="num">{{good.cart_num}}</span> =
                            <span class="price">&yen;{{good.commodity_current_price * good.cart_num | transformPrice}}</span>
                    </span>
                </div>
            </section>
        </div>
        <div id="pay-container">
            <div class="total-result">
                <p class="total-price">总计：&yen;{{totalPrice | transformPrice}}</p>
                <p v-if="orderTips">{{orderTips}}</p>
                <p v-else>（不含运费）</p>
            </div>
            <div class="to-pay-btn"
                 @click="payOrder">
                去结算
            </div>
        </div>
    </div>
    <address-choose
            :choosed.sync="address"
            :visible.sync="choosing">
    </address-choose>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    import { MessageBox } from 'mint-ui';
    import AddressChoose from '../Address/AddressChoose.vue';
    export default{
        data(){
            return {
                from: '',
                goods: [],
                address:{},
                choosing: false,
                totalPrice:0,
                checked_shop_config:false,
                orderTips:false
            }
        },
        components:{
            AddressChoose
        },
        created(){
            this.initOrder();
        },
        methods:{
            initOrder: function(){
                Indicator.open();
                let vm  = this;
                let query = vm.$route.query;
                vm.fetchDefaultAddress();
                vm.$set('from',query.from);
                query.from == 'cart' ? vm.fetchGoodsFromCart(query.cartIds,query.commodities)
                                     : vm.fetchGoods(query.commodity);
            },
            fetchDefaultAddress: function(){
                let vm = this;
                vm.$http.get('/api/default/address').then(function(response){
                    if(response.data.code == 0){
                        vm.$set('address',response.data.message);
                        if(vm.address == ''){
                            MessageBox.confirm('还未建立收货地址，马上去新建?').then(action => {
                                vm.$router.go('/add-address');
                            });
                        }
                    }
                    Indicator.close();
                });
            },
            fetchGoods: function(commodity){
                let vm = this;
                let data = commodity.split('-');
                let itemId = data[0];
                let cart_num = data[1];
                vm.$http.get('/api/commodity/'+itemId).then(response=>{
                    if(response.data.code == 0){
                        let goods = response.data.message;
                        goods.cart_num = cart_num;
                        vm.goods.push(goods);
                        vm.$nextTick(function(){
                            vm.calculatePrice();
                        });
                    }else{
                        Toast({
                              message: response.data.message
                        });
                    }
                });
            },
            fetchGoodsFromCart: function(cartIds,commodities){
                let vm = this;
                vm.$http.get('/api/commodities/'+commodities).then(response=>{
                    if(response.data.code == 0){
                        vm.$set('goods',response.data.message);
                        vm.$nextTick(function(){
                            vm.calculatePrice();
                        });
                    }else{
                        Toast({
                              message: response.data.message
                        });
                    }
                });
            },
            chooseAddress: function(){
                this.choosing = !this.choosing;
            },
            calculatePrice: function() {
                let price = 0;
                this.goods.forEach(function(value){
                    price += value.commodity_current_price * value.cart_num;
                });
                this.$set('totalPrice', price);
                let shopCacheConfig = localStorage.getItem('shopConfig');
                let shopConfig = JSON.parse(shopCacheConfig);
                if(price < shopConfig.config_free){
                    let tips = '（订单未满￥' + shopConfig.config_free + '，需额外支付邮费￥'+shopConfig.config_freight+'）';
                    this.$set('orderTips',tips);
                }else{
                    this.$set('orderTips','（本次订单免邮费）');
                }
            },
            payOrder: function(){
                Toast({
                    message: '结算功能正在开发中......'
                });
            },

        }
    }
</script>