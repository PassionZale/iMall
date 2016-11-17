<template>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!--<template v-for="banner in banners">-->
                <!--<div class="swiper-slide">-->
                    <!--<a href="{{banner.redirect_url}}">-->
                        <!--<img :src="banner.img_url"/>-->
                    <!--</a>-->
                <!--</div>-->
            <!--</template>-->
            <div class="swiper-slide">
                <a href="#">
                    <img :src="/uploads/banner/NFrqXGHtTu.png"/>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img :src="/uploads/banner/5OStC0jgzM.png"/>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img :src="/uploads/banner/Fy6LDCyxxf.png"/>
                </a>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</template>
<style scoped>
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
    export default{
        data(){
            return{
                banners:''
            }
        },
        ready(){
            this.fetchBanner();
        },
        methods:{
            fetchBanner:function(){
                let self = this;
                self.$http.get('/api/banners').then(function(response){
                    self.banners = response.data;
                    self.$nextTick(function(){
                        self.initSwiper();
                    });
                });
            },
            initSwiper:function(){
                let swiper = new Swiper('.swiper-container',{
                    autoplay:4000,
                    loop: true,
                    resizeReInit : true,
                    pagination: '.swiper-pagination'
                  });
            }
        }
    }

</script>
