<template>
    <section id="empty-cart-container" v-show="emptyVisible">
        <div class="empty-cart-wrapper">
            <img src="/images/common/cart.png"/>
            <h4>购物车快饿扁了T.T</h4>
            <p>主人快给我挑点宝贝吧</p>
            <a v-link="{name:'index'}">去逛逛</a>
        </div>
    </section>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return {
                cart:'',
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
                    vm.$set('cart',response.data.message);
                    if(vm.cart.length){
                        vm.$set('emptyVisible',false);
                    }else{
                        vm.$set('emptyVisible',true);
                    }
                });
            }
        }
    }
</script>