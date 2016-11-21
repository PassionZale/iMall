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
            this.fetchUser();
        },
        methods:{
            fetchUser:function(){
                let vm = this;
                let userInfo = localStorage.getItem('userInfo');
                if(userInfo){
                    vm.$set('user',JSON.parse(userInfo));
                }else{
                    vm.$http.get('/api/userinfo').then(function(response){
                        vm.$set('user',response.data);
                        localStorage.setItem('userInfo', JSON.stringify(response.data));
                    });
                }
            }
        }
    }
</script>
