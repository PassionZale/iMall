<template>

    <div id="cart-container" v-show="!emptyVisible">
        <section class="cart-wrap" v-for="cart in carts">
            <i class="select-one-btn" :class="cart.selected ? 'selected' : '' " @click="toggleSelect(cart)">
            </i>
            <a class="img-wrap" v-link="{name:'commodity',params:{hashid:cart.commodity.id}}">
                <img :src="cart.commodity.commodity_img"/>
                <p class="name">{{cart.commodity.commodity_name}}</p>
            </a>
            <div class="price-wrap">
            <span class="commodity-result">
                    <span>&yen;{{cart.commodity.commodity_current_price | transformPrice}}</span> *
            <span class="num">{{cart.commodity_num}}</span> =
            <span class="price">&yen;{{cart.commodity.commodity_current_price * cart.commodity_num | transformPrice}}</span>
            </span>
                <div class="commodity-num">
                <span class="minus-btn" :class=" cart.commodity_num > 1 ? 'active' : '' " @click="minusClick(cart)">
                        </span>
                    <input class="num" type="tel" value="{{cart.commodity_num}}" disabled>
                    <span class="plus-btn active" @click="plusClick(cart)">
                    </span>
                </div>
            </div>
        </section>
        <section class="remove-wrap"
                 @click="removeCarts">
                清空购物车
        </section>
    </div>

    <div id="pay-container" v-show="!emptyVisible">
        <i class="select-all-btn" :class="selecteAll ? 'selected' : '' " @click="selectAll(carts)">
        </i>
        <div class="total-result">
            <p class="total-price">总计：&yen;{{totalPrice | transformPrice}}</p>
            <p>（不含运费）</p>
        </div>
        <div class="to-pay-btn"
            @click="toSettle">
            去结算
        </div>
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
export default {
    data() {
            return {
                carts: '',
                selecteAll: true,
                emptyVisible: false,
                totalPrice: 0
            }
        },
        ready() {
            this.fetchCart();
        },
        methods: {
            fetchCart: function() {
                Indicator.open();
                let vm = this;
                vm.$http.get('/api/cart').then(function(response) {
                    Indicator.close();
                    let data = response.data.message;
                    if (data.length) {
                        for (var i in data) {
                            data[i].selected = true;
                        }
                        vm.$set('carts', data);
                        vm.$set('emptyVisible', false);
                        vm.$nextTick(function() {
                            vm.calculatePrice();
                        });
                    } else {
                        vm.$set('emptyVisible', true);
                    }
                });
            },
            minusClick: function(cart) {
                if (cart.commodity_num > 1) {
                    cart.commodity_num = (parseInt(cart.commodity_num) - 1);
                    this.calculatePrice();
                };
            },
            plusClick: function(cart) {
                cart.commodity_num = (parseInt(cart.commodity_num) + 1);
                this.calculatePrice();
            },
            toggleSelect: function(cart) {
                cart.selected = !cart.selected;
                if (!cart.selected) {
                    this.selecteAll = false;
                } else {
                    let selected = 0;
                    let count = this.carts.length;
                    for (var i in this.carts) {
                        if (this.carts[i].selected) {
                            selected++;
                        }
                    }
                    if (count == selected) {
                        this.selecteAll = true;
                    }
                }
                this.calculatePrice();
            },
            selectAll: function(carts) {
                this.selecteAll = !this.selecteAll;
                if (this.selecteAll) {
                    for (var i in carts) {
                        carts[i].selected = true;
                    }
                } else {
                    for (var i in carts) {
                        carts[i].selected = false;
                    }
                }
                this.calculatePrice();
            },
            calculatePrice: function() {
                let price = 0;
                this.carts.forEach(function(value){
                    if (value.selected) {
                        price += value.commodity.commodity_current_price * value.commodity_num;
                    }
                });
                this.$set('totalPrice', price);
            },
            removeCarts: function(){
                let vm = this;
                Indicator.open();
                vm.$http.post('/api/cart/empty').then(function(response){
                    Indicator.close();
                    if(response.data.code == 0){
                        vm.$set('carts','');
                        vm.$nextTick(function(){
                            vm.$set('emptyVisible',true);
                        });
                    }
                    Toast({
                          message: response.data.message
                    });
                });
            },
            toSettle: function(){
                let vm = this;
                let commodites = '';
                let cartIds = '';
                vm.carts.forEach(function(value){
                    if(value.selected){
                        commodites += value.commodity.id + '-' + value.commodity_num + ',';
                        cartIds += value.id + ',';
                    }
                });
                let order = {from:'cart',commodities:commodites,cartIds:cartIds};
                vm.$route.router.go({name:'order-settle',query:order});
            }
        }
}
</script>
