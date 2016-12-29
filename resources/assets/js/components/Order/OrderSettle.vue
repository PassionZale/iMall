<template>
    <div id="to-pay-container">
        <div class="address-wrap">
            <div class="address-default">
                <span>收货地址</span>
                <ul v-show="address != ''"
                    v-link="{name:'choose-address',params:{'hashid':address.id}}">
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
                        您还未新建收货地址
                    </li>
                    <li>
                        点我去管理收货地址
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    import { MessageBox } from 'mint-ui';
    export default{
        data(){
            return {
                from: '',
                goods: '',
                address:'',
            }
        },
        created(){
            this.initOrder();
        },
        methods:{
            initOrder: function(){
                Indicator.open();
                let vm  = this;
                vm.fetchDefaultAddress();
                let query = vm.$route.query;
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

            },
            fetchGoodsFromCart: function(cartIds,commodites){
                console.log(cartIds);
                console.log(commodites);
            }
        }
    }

</script>