<template>
    <mt-swipe class="my-swipe" :auto="5000">
        <template v-for="banner in banners">
            <mt-swipe-item class="my-swipe-item">
                <a href="{{banner.redirect_url}}">
                    <img :src="banner.img_url">
                </a>
            </mt-swipe-item>
        </template>
    </mt-swipe>
</template>
<style scoped>
    .my-swipe{
        width:100%;
        height:200px;
    }
    img{
        display:block;
        width:100%;
        height:auto;
    }
</style>
<script>
    import { Swipe, SwipeItem } from 'mint-ui';
    export default{
        data(){
            return{
                banners:[]
            }
        },
        components:{
            Swipe, SwipeItem
        },
        ready(){
            this.fetchBanner();
        },
        methods:{
            fetchBanner:function(){
                let self = this;
                self.$http.get('/api/banners').then(function(response){
                    response.data.forEach(function(item){
                        self.banners.push(item);
                    });
                });
            }
        }
    }
</script>