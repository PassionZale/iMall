<template>
    <div class="plate-wrapper">
        <img :src="plate.plate_img" v-for="plate in plates">
    </div>
</template>
<style scoped>
    img{
        display:block;
        width:100%;
        height:auto;
        margin-bottom:10px;
    }
</style>
<script>
    export default{
        data(){
            return{
                plates:''
            }
        },
        ready(){
            this.fetchPlates();
        },
        methods:{
            fetchPlates:function(){
                let vm = this;
                this.$http.get('/api/plates').then(function(response){
                    vm.$set('plates',response.data);
                });
            }
        }
    }
</script>
