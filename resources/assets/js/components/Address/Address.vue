<template>
    <div id="uc-address-container">
        <div class="uc-address-part">
            <mt-cell title="新增地址" v-link="{name:'add-address'}" class="add-address-btn">
                <img src="/images/common/add.png" width="24" height="24">
            </mt-cell>
        </div>
        <div class="uc-address-part"
             v-for="address in addresses"
             v-link="{name:'edit-address',params:{'hashid':address.id}}"
             :class="address.defaulted == 1 ? 'defaulted-address' : '' ">
            <mt-cell-swipe
                    :title="address.name"
                    :label="address.defaulted == 1 ? '默认地址' : '' "
                    >
                <p>{{address.province}} {{address.city}} {{address.district}} </p>
                <p>{{address.address}}</p>
            </mt-cell-swipe>
        </div>
    </div>
</template>

<script>
    import { CellSwipe } from 'mint-ui';
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return{
                addresses:''
            }
        },
        components:{
            CellSwipe
        },
        ready(){
            this.fetchAddress();
        },
        methods:{
            fetchAddress:function(){
                let vm = this;
                Indicator.open();
                vm.$http.get('/api/address').then(function(response){
                    if(response.data.code === -1){
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
            }
        }
    }
</script>
