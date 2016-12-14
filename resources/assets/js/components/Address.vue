<template>
    <div id="uc-address-container">
        <div class="uc-address-part">
            <mt-cell title="新增地址" v-link="{name:'add-address'}" class="add-address-btn">
                <img src="/images/common/add.png" width="24" height="24">
            </mt-cell>
        </div>
    </div>
</template>

<script>
    import { Button } from 'mint-ui';
    import { Cell } from 'mint-ui';
    import { CellSwipe } from 'mint-ui';
    export default{
        data(){
            return{
                addresses:''
            }
        },
        components:{
            Cell, Button
        },
        ready(){
            this.fetchAddress();
        },
        methods:{
            fetchAddress:function(){
                let vm = this;
                vm.$http.get('/api/address').then(function(response){
                    console.log(response.data);
                });
            }
        }
    }
</script>
