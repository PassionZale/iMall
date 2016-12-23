<template>
    <div id="to-pay-container">
        <div class="address-wrap">
            收货地址
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
                addresses:'',
            }
        },
        created(){
            this.initOrder();
        },
        methods:{
            initOrder: function(){
                Indicator.open();
                let vm  = this;
                vm.fetchAddress();
                let query = vm.$route.query;
                vm.$set('from',query.from);
                query.from == 'cart' ? vm.fetchGoodsFromCart(query.cartIds,query.commodities)
                                     : vm.fetchGoods(query.commodity);
            },
            fetchAddress: function(){
                let vm = this;
                vm.$http.get('/api/address').then(function(response){
                    if(response.data.code == 0){
                        vm.$set('addresses',response.data.message);
                        if(vm.addresses.length == 0){
                            MessageBox.confirm('还未建立收货地址，马上去新建?').then(action => {
                                vm.$router.go('/add-address');
                            });
                        }
                        Indicator.close();
                    }
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