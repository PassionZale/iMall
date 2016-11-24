<template>
    <section id="empty-cart-container" v-if="!cart.count">
        <div class="empty-cart-wrapper">
            <img src="/images/common/cart.png"/>
            <h4>购物车快饿扁了T.T</h4>
            <p>主人快给我挑点宝贝吧</p>
            <a v-link="{name:'index'}">去逛逛</a>
        </div>
    </section>
</template>

<script>
    export default{
        data(){
            return {
                cart:{
                    count:0,
                    data:[]
                }
            }
        },
        ready(){
            this.fetchCart();
        },
        methods:{
            fetchCart:function(){
                // TODO ajax load cart data
                return false;
            }
        }
    }

</script>