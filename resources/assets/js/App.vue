<template>
    <h1>{{user.nickname}}</h1>
    <router-view></router-view>
</template>

<script>

    export default{
        replace: false,
        data(){
            return{
                msg:'iMall',
                user:''
            }
        },
        created(){
            this.fecthUser();
        },
        methods:{
            fecthUser:function(){
                this.$http.get('/api/userinfo').then(function(response){
                    let user = {openid:'',nickname:'',avatar:''};
                    localStorage.setItem('user.openid', response.data.id);
                    localStorage.setItem('user.nickname',  response.data.nickname);
                    localStorage.setItem('user.avatar', response.data.avatar);
                    this.user = localStorage.getItem('user');
                });
            }
        }
    }

</script>
