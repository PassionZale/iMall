<template>
    <h1>{{msg}}</h1>
    <router-view></router-view>
</template>

<script>

    export default{
        data(){
            return{
                msg:'iMall'
            }
        }
    }

</script>
