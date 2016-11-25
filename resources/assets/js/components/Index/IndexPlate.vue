<template>
    <div class="plate-wrapper">
        <a v-link="{name:'byTopic',params:{'hashid':plate.id}}" v-for="plate in plates">
            <img :src="plate.plate_img" />
        </a>
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
