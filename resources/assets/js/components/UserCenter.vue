<template>
    <header id="uc-head-container">
        <img class="bg-img" src="/images/common/uc-bg.jpg">
        <img class="avatar-img" :src="user.avatar">
    </header>
</template>

<script>
    export default{
        data(){
            return {
                user:''
            }
        },
        ready(){
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

