<template>
    <swiper :list="banner" auto></swiper>
</template>

<script>
    import Swiper from 'vux/dist/components/swiper'
    export default{
        data(){
            return{
                banner:[]
            }
        },
        components:{
            Swiper
        },
        created(){
            this.fetchBanner();
        },
        methods:{
            fetchBanner:function(){
                let self = this;
                this.$http.get('/api/banners').then(function(response){
                    response.data.forEach(function(item){
                        let obj = {title:'',img:'',url:''};
                        obj.title = item.title;
                        obj.img = item.img_url;
                        obj.url = item.redirect_url;
                        self.banner.push(obj);
                    });
                });
            }
        }
    }
</script>
