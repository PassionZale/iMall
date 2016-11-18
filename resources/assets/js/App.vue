
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
            this.initUser();
        },
        methods:{
			initUser:function(){
				alert('initUser');
			  this.$http.get('/api/userinfo').then((response) => {
					alert(response.data);
					this.$set('user',response.data);
					alert(typeof this.user);
			  }, (response) => {
				alert('error');
			  });
				alert('finish');
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
