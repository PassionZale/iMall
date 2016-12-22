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
                this.fetchAddress();
                let query = this.$route.query;
                this.$set('from',query.from);
                query.from == 'cart' ? this.fetchGoodsFromCart(query.cartIds,query.commodities)
                                        : this.fetchGoods(query.commodity);
                Indicator.close();
            },
            fetchAddress: function(){
                let vm = this;
                vm.$http.get('/api/address').then(function(response){
                    if(response.data.code == 0){
                        vm.$set('addresses',response.data.message);
                        vm.$nextTick(function(){
                            Indicator.close();
                        });
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