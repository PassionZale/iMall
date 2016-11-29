<template>
    <section id="empty-data-container" v-show="empty">
        <div class="empty-data-wrapper">
            <img src="/images/common/empty.png"/>
            <h4>没有找到相关商品T.T</h4>
            <p>老板太懒了，先去其他位置逛逛吧</p>
            <a v-link="{name:'category'}">去逛逛</a>
        </div>
    </section>
</template>

<script>
    import { Indicator } from 'mint-ui';
    export default{
        props:{
            sortKey:{
                type:String,
                default:''
            }
        },
        data(){
            return{
                data:'',
                empty:false
            }
        },
        ready(){
            this.fetchCommodies();
        },
        methods:{
            fetchCommodies:function(){
                Indicator.open();
                let vm = this;
                vm.$http.post('/api/commodities/plate',{
                    plate_id : vm.$route.params.hashid
                }).then(function(response){
                    vm.$set('data',response.data);
                    vm.$nextTick(function(){
                        Indicator.close();
                        vm.data == '' ? vm.$set('empty',true) : vm.$set('empty',false);
                    });
                });
            }
        }
    }
</script>
