<template>
	<p v-for="banner in banners">{{banner.id}}<p>
    <div class="swiper-container">
        <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="banner in banners">
					{{banner.id}}
                </div>
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
                this.$http.get('/api/banners').then(function(response){
                    this.$set('banners',response.data);
					setInterval(function(){
							var swiper = new Swiper('.swiper-container',{
								autoplay:4000,
								loop: true,
								resizeReInit : true,
								pagination: '.swiper-pagination',
								observer:true,
								observeParents:true
							 });
						},3000);
                });
            }
        }
    }
</script>
