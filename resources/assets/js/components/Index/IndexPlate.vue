<template>
    <div class="plate-wrapper">
        <a v-link="{name:'aPlate',params:{'hashid':plate.id}}" v-for="plate in plates">
            <img v-lazy="plate.plate_img"/>
        </a>
    </div>
</template>
<style scoped>
    a{
        display:block;
        width:100%;
        min-height:10rem;
        position:relative;
    }
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
