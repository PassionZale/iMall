<template>
    <div>
        <p>{{commodity.commodity_name}}</p>
    </div>
    <div id="commodity-detail-btn-group">
        <button>加入购物车</button>
    </div>
</template>

<style>
    #commodity-detail-btn-group{
        position:fixed;
        bottom:0;
        left:0;
        width:200px;
        height:50px;
    }
</style>
<script>
    import { Indicator } from 'mint-ui';
    import { Toast } from 'mint-ui';
    export default{
        data(){
            return {
                commodity:''
            }
        },
        ready(){
            this.fetchCommodity();
        },
        methods:{
            fetchCommodity:function(){
                Indicator.open();
                let vm = this;
                let itemId = vm.$route.params.hashid;
                vm.$http.get('/api/commodity/'+itemId).then(function(response){
                    Indicator.close();
                    if(response.data.code === 0){
                        let commodity = response.data.message;
                        vm.$set('commodity',commodity);
                    }else{
                        Toast({
                          message: response.data.message
                        });
                        vm.$router.go('/category');
                    }
                });
            }
        }
    }

</script>