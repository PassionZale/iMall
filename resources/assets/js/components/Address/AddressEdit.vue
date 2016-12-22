<template>
    <div id="uc-address-container">

        <div class="uc-address-part">
            <mt-field label="收货人：" placeholder="请填写收货人姓名" :value.sync="address.name"></mt-field>
            <mt-field label="手机号码：" placeholder="请填写手机号码" type="tel" :value.sync="address.phone"></mt-field>
        </div>

        <div class="uc-address-part" id="distpicker-edit">
            <mt-cell title="省：" class="mint-field">
                <select id="province-picker" v-model="address.province"></select>
            </mt-cell>
            <mt-cell title="市：" class="mint-field">
                <select id="city-picker" v-model="address.city"></select>
            </mt-cell>
            <mt-cell title="区：" class="mint-field">
                <select id="area-picker" v-model="address.district"></select>
            </mt-cell>
        </div>

        <div class="uc-address-part">
            <mt-field label="详细地址：" placeholder="请填写详细地址" :value.sync="address.address"></mt-field>
        </div>

        <div class="uc-address-part">
            <mt-cell title="默认地址" label="每次购买时会默认使用该地址">
                <mt-switch :value.sync="address.defaulted"></mt-switch>
            </mt-cell>
        </div>

    </div>
    <div class="edit-address-btn-group">
        <button class="delete-address-btn" @click="deleteAddress(address)">删除</button>
        <button class="edit-address-btn" @click="editAddress">保存</button>
    </div>
</template>
<script>
    import Vue from 'vue';
    import { Field } from 'mint-ui';
    import { Cell } from 'mint-ui';
    import { Indicator } from 'mint-ui';
    import { Switch } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return{
                address:''
            }
        },
        components:{
            Field, Cell, Switch
        },
        created(){
            this.fetchAddress();
        },
        methods:{
            fetchAddress: function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/address/'+itemId).then(function(response){
                    Indicator.close();
                    if(response.data.code === 0){
                        let address = response.data.message;
                        address.defaulted == 1 ? address.defaulted = true : address.defaulted = false;
                        vm.$set('address',address);
                        vm.$nextTick(function(){
                            $("#distpicker-edit").distpicker({
                              province: address.province,
                              city: address.city,
                              district: address.district
                            });
                        });
                    }else{
                        Toast({
                          message: response.data.message
                        });
                        window.history.go(-1);
                    }
                });
            },
            editAddress:function(){
                let vm = this;
                Indicator.open();
                vm.$http.put('/api/address/'+vm.address.id,vm.address).then(function(response){
                    Indicator.close();
                    Toast({
                          message: response.data.message
                    });
                    if(response.data.code === 0){
                        window.history.go(-1);
                    }
                });
            },
            deleteAddress:function(address){
                let vm = this;
                Indicator.open();
                vm.$http.delete('/api/address/'+address.id).then(function(response){
                    Indicator.close();
                    Toast({
                        message: response.data.message
                    });
                    if(response.data.code === 0){
                        window.history.go(-1);
                    }
                });
            }
        }
    }
</script>
