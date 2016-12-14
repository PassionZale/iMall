<template>
    <div id="uc-address-container">
        <div class="uc-address-part">
            <a class="add-address-btn" v-link="{name:'add-address'}">添加新地址</a>
        </div>
    </div>
</template>

<script>
    import { Field } from 'mint-ui';
    import { Button } from 'mint-ui';
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{
            Field, Button
        }
    }
</script>
