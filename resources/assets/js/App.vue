
<template>
    <router-view></router-view>
    <navbar></navbar>
</template>

<script>
    import Navbar from './components/Navbar.vue';

    export default{
        components:{
            Navbar
        },
        replace: false,
        data(){
            return{
                user:''
            }
        },
        created(){
			this.isWeixin();
            this.fetchUser();
        },
        methods:{
			isWeixin:function(){
				let ua = window.navigator.userAgent.toLowerCase();
				if(ua.match(/MicroMessenger/i) == 'micromessenger') {
					// 若response.data为String类型，将其格式化成JSON类型
					alert('微信内置浏览器');
				}else{
					alert('非微信浏览器');
				}
			},
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
            }
        }
    }

</script>
