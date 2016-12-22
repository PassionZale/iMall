<template>
    <img class="commodity-img"  :src="commodity.commodity_img"/>
    <div id="commodity-container">
        <p class="name">{{commodity.commodity_name}}</p>
        <p class="price">
            &yen;{{commodity.commodity_current_price | transformPrice}}&emsp;
            <del>&yen;{{commodity.commodity_original_price | transformPrice}}</del>
            <span>剩余：{{commodity.commodity_stock_number}}件</span>
        </p>
    </div>
    <div id="number-container">
        <p>数量：</p>
        <div class="num-wrap">
            <span class="minus-btn"
                  :class=" commodity_num > 1 ? 'active' : '' "
                  @click="minusClick(commodity_num)">
            </span>
            <input class="num" type="tel" v-model="commodity_num">
            <span class="plus-btn active" @click="plusClick(commodity_num)">
            </span>
        </div>
    </div>
    <div id="detail-container">
        <ul class="title-wrap">
            <li @click="detailToggle"
                :class=" detailVisible ? 'active' : '' ">
                商品详情
            </li>
            <li @click="detailToggle"
                :class=" detailVisible ? '' : 'active' ">
                商品简介
            </li>
        </ul>
        <div class="detail-wrap" v-show="detailVisible">
            {{{commodity.commodity_detail_info}}}
        </div>
        <div class="base-wrap" v-show="!detailVisible">
            {{{commodity.commodity_base_info | rnTransform}}}
        </div>
    </div>
    <div style="width:100%;height:60px;"></div>
    <div id="btn-groups-container">
        <div class="cart-wrap" v-link="{name:'cart'}">
            <mt-badge
                    type="error"
                    size="small"
                    v-show="cartCount > 0">
                {{cartCount}}
            </mt-badge>
        </div>
        <div class="add-cart-btn" @click="addCart">加入购物车</div>
        <div class="to-pay-btn" @click="toPay">立即购买</div>
    </div>
</template>

<style scoped>
    #commodity-detail-btn-group{
        position:fixed;
        bottom:0;
        left:0;
        width:200px;
        height:50px;
    }
</style>
<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    import { Badge } from 'mint-ui';
    export default{
        data(){
            return {
                commodity:'',
                sheetVisible:false,
                detailVisible:true,
                commodity_num:1,
                cartCount:0,
            }
        },
        components:{
            Badge
        },
        created(){
            this.fetchCommodity();
        },
        methods:{
            fetchCommodity:function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/commodity/'+itemId).then(function(response){
                    Indicator.close();
                    if(response.data.code == 0){
                        let commodity = response.data.message;
                        vm.$set('commodity',commodity);
                        vm.fetchCartCount();
                    }else{
                        Toast({
                          message: response.data.message
                        });
                        vm.$router.go('/category');
                    }
                });
            },
            fetchCartCount:function(){
                let vm = this;
                vm.$http.get('/api/cart/count').then(function(response){
                    if(response.data.code == 0){
                        vm.$set('cartCount',response.data.message);
                    }
                });
            },
            minusClick: function(num){
                (num > 1) &&  this.$set('commodity_num',num-1);
            },
            plusClick: function(num){
                this.$set('commodity_num',num+1);
            },
            detailToggle: function(){
                this.detailVisible = !this.detailVisible;
            },
            addCart: function(){
                Indicator.open();
                let vm = this;
                vm.$http.post('/api/cart',{
                        commodity_id:vm.commodity.id,
                        commodity_num:vm.commodity_num
                    }).then(function(response){
                        Indicator.close();
                        if(response.data.code == 0){
                            if(response.data.extra == 'store'){
                                vm.cartCount = vm.cartCount + 1;
                            }
                        }
                        Toast({
                            message: response.data.message
                        });
                    });
            },
            toPay: function(){
                let commodity = this.commodity.id+ '-' + this.commodity_num;
                let order = {from:'default',commodity:commodity};
                this.$route.router.go({name:'order-settle',query:order});
            }
        }
    }

</script>