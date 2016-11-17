<template>
    <div id='slider' class='swipe'>
        <div class='swipe-wrap'>
            <template v-for="banner in banners">
                <div>
                    <a href="{{banner.redirect_url}}">
                        <img :src="banner.img_url">
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>
<style scoped>
.swipe {
  overflow: hidden;
  visibility: hidden;
  position: relative;
}
.swipe-wrap {
  width:100%;
  overflow: hidden;
  position: relative;
}
.swipe-wrap > div {
  float:left;
  width:100%;
  position: relative;
}
</style>
<script>
    export default{
        data(){
            return{
                banners:[]
            }
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
                    self.$nextTick(function(){
                        window.mySwipe = new Swipe(document.getElementById('slider'), {
                            startSlide: 2,
                            speed: 400,
                            auto: 3000,
                            continuous: true,
                            disableScroll: false,
                            stopPropagation: false,
                            callback: function(index, elem) {},
                            transitionEnd: function(index, elem) {}
                        });
                    });
                });
            }
        }
    }
</script>