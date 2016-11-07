<template>
    <h1>iMall</h1>
    <router-view :user></router-view>
</template>

<script>

    export default{
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
