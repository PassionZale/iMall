<template>
    <header id="uc-head-container">
        <img class="bg-img" src="/images/common/uc-bg.jpg">
        <img class="avatar-img" :src="user.avatar">
    </header>
    <section id="uc-nav-container">
        <div class="nav-wrapper">
            <mt-cell title="待付款" is-link v-link="{name:'category'}">
                <img slot="icon" src="/images/icon/order-unpay.png" width="24" height="24">
            </mt-cell>
            <mt-cell title="待发货" is-link v-link="{name:'category'}">
                <img slot="icon" src="/images/icon/order-delivered.png" width="24" height="24">
            </mt-cell>
            <mt-cell title="待收货" is-link v-link="{name:'category'}">
                <img slot="icon" src="/images/icon/order-receipt.png" width="24" height="24">
            </mt-cell>
            <mt-cell title="已完成" is-link v-link="{name:'category'}">
                <img slot="icon" src="/images/icon/order-finish.png" width="24" height="24">
            </mt-cell>
        </div>
        <div class="nav-wrapper">
            <mt-cell title="地址管理" is-link v-link="{name:'address'}">
                <img slot="icon" src="/images/icon/uc-address.png" width="24" height="24">
            </mt-cell>
        </div>
        <div class="nav-wrapper">
            <mt-cell title="意见建议" is-link v-link="{name:'suggestion'}">
                <img slot="icon" src="/images/icon/uc-suggestion.png" width="24" height="24">
            </mt-cell>
        </div>
    </section>
</template>

<script>
    import { Cell } from 'mint-ui'
    export default{
        data(){
            return {
                user:''
            }
        },
        components:{
            Cell
        },
        created(){
            this.initHeader();
        },
        methods:{
            initHeader:function(){
                let vm = this;
                vm.$set('user',vm.$parent.user);
            }
        }
    }
</script>

