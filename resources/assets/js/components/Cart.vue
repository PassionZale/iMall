<template>
    <div id="cart-container">
        <section v-for="cart in carts">
            {{cart.commodity_id}}<br>
            {{cart.commodity_num}}
        </section>
    </div>
    <div id="empty-cart-container" v-show="emptyVisible">
        <div class="empty-cart-wrapper">
            <img src="/images/common/cart.png"/>
            <h4>购物车快饿扁了T.T</h4>
            <p>主人快给我挑点宝贝吧</p>
            <a v-link="{name:'index'}">去逛逛</a>
        </div>
    </div>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return {
                carts:'',
                emptyVisible:false
            }
        },
        ready(){
            this.fetchCart();
        },
        methods:{
            fetchCart:function(){
                Indicator.open();
                let vm = this;
                vm.$http.get('/api/cart').then(function(response){
                    Indicator.close();
                    vm.$set('carts',response.data.message);
                    if(vm.carts.length){
                        vm.$set('emptyVisible',false);
                    }else{
                        vm.$set('emptyVisible',true);
                    }
                });
            }
        }
    }
</script>