<style>
@import '~vux/dist/vux.css';
</style>

<template>
    <swiper :list="banner" auto></swiper>
    <router-view></router-view>
    <tabbar>
        <tabbar-item>
            <img slot="icon" src="https://o84lhz5xo.qnssl.com/master/src/assets/demo/icon_nav_button.png">
            <span slot="label">Wechat</span>
        </tabbar-item>
        <tabbar-item show-dot>
            <img slot="icon" src="https://o84lhz5xo.qnssl.com/master/src/assets/demo/icon_nav_msg.png">
            <span slot="label">Message</span>
        </tabbar-item>
        <tabbar-item selected>
            <img slot="icon" src="https://o84lhz5xo.qnssl.com/master/src/assets/demo/icon_nav_article.png">
            <span slot="label">Explore</span>
        </tabbar-item>
        <tabbar-item>
            <img slot="icon" src="https://o84lhz5xo.qnssl.com/master/src/assets/demo/icon_nav_cell.png">
            <span slot="label">News</span>
        </tabbar-item>
    </tabbar>
</template>

<script>
    import Swiper from 'vux/dist/components/swiper'
    import Tabbar from 'vux/dist/components/tabbar'
    import TabbarItem from 'vux/dist/components/tabbar-item'

    export default{
        components:{
            Swiper,Tabbar,TabbarItem
        },
        replace: false,
        data(){
            return{
                user:'',
                banner:[],
            }
        },
        created(){
            this.fetchUser();
            this.fetchBanner();
        },
        methods:{
            fetchUser:function(){
                let userInfo = {};
                userInfo = localStorage.getItem(userInfo);
                if(userInfo){
                    this.user = JSON.parse(userInfo);
                }else{
                    this.$http.get('/api/userinfo').then(function(response){
                        localStorage.setItem('userInfo', JSON.stringify(response.data));
                        this.user = JSON.parse(localStorage.getItem('userInfo'));
                    });
                }
            },
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
