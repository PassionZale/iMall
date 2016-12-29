<template>
    <div id="uc-address-container">

        <div class="uc-address-part">
            <mt-field label="收货人：" placeholder="请填写收货人姓名" :value.sync="form_data.name"></mt-field>
            <mt-field label="手机号码：" placeholder="请填写手机号码" type="tel" :value.sync="form_data.phone"></mt-field>
        </div>

        <div class="uc-address-part" id="distpicker-add" data-toggle="distpicker">
            <mt-cell title="省：" class="mint-field">
                <select id="province-picker" data-province="---- 请选择省 ----" v-model="form_data.province"></select>
            </mt-cell>
            <mt-cell title="市：" class="mint-field">
                <select id="city-picker" data-city="---- 请选择市 ----" v-model="form_data.city"></select>
            </mt-cell>
            <mt-cell title="区：" class="mint-field">
                <select id="area-picker" data-district="---- 请选择区 ----" v-model="form_data.district"></select>
            </mt-cell>
        </div>

        <div class="uc-address-part">
            <mt-field label="详细地址：" placeholder="请填写详细地址" :value.sync="form_data.address"></mt-field>
        </div>

        <div class="uc-address-part">
            <mt-cell title="默认地址" label="每次购买时会默认使用该地址">
                <mt-switch :value.sync="form_data.defaulted"></mt-switch>
            </mt-cell>
        </div>

    </div>
    <div class="save-address-btn" @click="addAddress">
        确定
    </div>
</template>
<script>
    import { Field } from 'mint-ui';
    import { Cell } from 'mint-ui';
    import { Indicator } from 'mint-ui';
    import { Switch } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return{
                form_data:{
                    name:'',
                    phone:'',
                    province:'',
                    city:'',
                    district:'',
                    address:'',
                    defaulted:false
                }
            }
        },
        components:{
            Field, Cell, Switch
        },
        ready(){
            // 初始化distpicker
            $(function(){
                $('#distpicker-add').distpicker();
            });
        },
        methods:{
            addAddress:function(){
                let vm = this;
                Indicator.open();
                vm.$http.post('/api/address',vm.form_data).then(function(response){
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
