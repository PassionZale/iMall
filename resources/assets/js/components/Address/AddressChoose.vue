<template>
    <div id="uc-address-container">
        <div class="uc-address-part">
            <mt-cell title="新增地址" v-link="{name:'add-address'}" class="add-address-btn">
                <img src="/images/common/add.png" width="24" height="24">
            </mt-cell>
        </div>
        <div class="uc-address-part"
             v-for="address in addresses">
            <mt-cell
                    :title="address.name"
                    :label="address.defaulted == 1 ? '默认地址' : '' "
                    >
                <img v-if="address.id == $route.params.hashid" slot="icon" src="/images/icon/cart-selected-icon.png" width="24" height="24">
                <img v-else slot="icon" src="/images/icon/cart-unselected-icon.png" width="24" height="24">
                <p style="font-size:14px;" @click="addressChoose(address)">
                    {{address.province}}{{address.city}}{{address.district}}{{address.address}}
                    <a class="edit-address-btn" v-link="{name:'edit-address',params:{'hashid':address.id}}"></a>
                </p>
            </mt-cell>
        </div>
    </div>
</template>
<style>
.edit-address-btn{
    display:inline-block;
    width:20px;
    height:20px;
    background-image:url('/images/icon/address-edit-icon.png');
    background-repeat:no-repeat;
    background-size:20px 20px;
}
</style>
<script>
    import { Cell } from 'mint-ui';
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return{
                addresses:''
            }
        },
        components:{
            Cell
        },
        created(){
            this.fetchAddress();
        },
        methods:{
            fetchAddress:function(){
                let vm = this;
                Indicator.open();
                vm.$http.get('/api/address').then(function(response){
                    if(response.data.code == -1){
                        Indicator.close();
                        Toast({
                          message: response.data.code
                        });
                    }else{
                        vm.$set('addresses',response.data.message);
                        vm.$nextTick(function(){
                            Indicator.close();
                        });
                    }
                });
            },
            addressChoose: function(address){
                let choosed = {
                    'id': address.id,
                    'province':address.province,
                    'city':address.city,
                    'district':address.district,
                    'address':address.address,
                    'phone':address.phone,
                    'defaulted':address.defaulted,
                    'choosed':'choosed'
                };
                this.$route.router.go({name:'order-settle',query:choosed});
            }
        }
    }
</script>
