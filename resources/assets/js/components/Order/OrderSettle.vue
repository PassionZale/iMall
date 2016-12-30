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
                goods: '',
                address:{},
                choosing: false
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
                vm.$http.get('/api/commodity/'+itemId).then(response=>{

                });
            },
            fetchGoodsFromCart: function(cartIds,commodites){
                let vm = this;
            },
            chooseAddress: function(){
                this.choosing = !this.choosing;
            }
        }
    }

</script>