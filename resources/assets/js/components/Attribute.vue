<template>
    <div>
        <div class="sequence-container">
            <ul></ul>
        </div>
        <router-view></router-view>
    </div>
</template>
<style lang="stylus" scoped>
body
    background-color:#d7d7d7;
</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{
        }
    }
</script>
