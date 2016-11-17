<template>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <template v-for="banner in banners">
                <div class="swiper-slide">
                    <a href="{{banner.redirect_url}}">
                        <img :src="banner.img_url"/>
                    </a>
                </div>
            </template>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</template>
<style scoped>
@import '../../../../../public/js/lib/swiper/swiper.min.css';
.swiper-container{
    width:100%;
    height:180px;
}
img{
    width:100%;
    height:auto;
}
</style>
<script>
    import swipe from "../../../../../public/js/lib/swiper/swiper.min.js"
    export default{
        data(){
            return{
                banners:''
            }
        },
        created(){
            this.fetchBanner();
        },
        methods:{
            fetchBanner:function(){
                let self = this;
                self.$http.get('/api/banners').then(function(response){
                    self.$set('banners',response.data);
                    this.$nextTick(function(){
                        var swiper = new Swiper('.swiper-container',{
                            autoplay:4000,
                            loop: true,
                            resizeReInit : true,
                            pagination: '.swiper-pagination'
                         });
                    });
                });
            }
        }
    }
</script>
