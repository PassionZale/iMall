<style>
@import '~vux/dist/vux.css';
</style>

<template>
    <!--<d-n-d></d-n-d>-->
    <router-view></router-view>
    <div>
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
    </div>
</template>

<script>
    import DND from './components/common/DND.vue'
    import Tabbar from 'vux/dist/components/tabbar'
    import TabbarItem from 'vux/dist/components/tabbar-item'

    export default{
        components:{
            DND,Tabbar,TabbarItem
        },
        replace: false,
        data(){
            return{
                user:''
            }
        },
        created(){
            this.fecthUser();
        },
        methods:{
            fecthUser:function(){
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
            }
        }
    }
</script>
