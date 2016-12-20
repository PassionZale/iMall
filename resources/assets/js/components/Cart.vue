<template>
    <div id="cart-container">
        <section class="cart-wrap"
                 v-for="(cart, index) in carts">
            <i class="select-one-btn"
                @click="toggleSelect(index)">
            </i>
            <a class="img-wrap" v-link="{name:'commodity',params:{hashid:cart.commodity.id}}">
                <img :src="cart.commodity.commodity_img"/>
                <p class="name">{{cart.commodity.commodity_name}}</p>
            </a>
            <div class="price-wrap">
                <span class="commodity-result">
                    <span>&yen;{{cart.commodity.commodity_current_price}}</span>
                    *
                    <span class="num">{{cart.commodity_num}}</span>
                    =
                    <span class="price">&yen;{{cart.commodity.commodity_current_price * cart.commodity_num}}</span>
                </span>
                <div class="commodity-num">
                        <span class="minus-btn"
                              :class=" cart.commodity_num > 1 ? 'active' : '' "
                              @click="minusClick(cart)">
                        </span>
                    <input class="num" type="tel" value="{{cart.commodity_num}}">
                    <span class="plus-btn active"
                          @click="plusClick(cart)">
                    </span>
                </div>
            </div>
        </section>
    </div>
    <div id="empty-cart-container" v-if="emptyVisible">
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
                selected:[],
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
            },
            minusClick: function(cart){
                if(cart.commodity_num > 1){
                    cart.commodity_num = cart.commodity_num - 1;
                };
            },
            plusClick: function(cart){
                cart.commodity_num = cart.commodity_num + 1;
            },
            toggleSelect: function(index){
                if(this.selected.indexOf(index) == 0){
                    this.selected.$remove(index);
                }else{
                    this.selected.push(index);
                }
            }
        }
    }
</script>