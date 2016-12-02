<template>
    <empty-data :is-show.sync="empty"></empty-data>
    <commodity-list :list.sync="data"></commodity-list>
</template>

<script>
    import { Indicator } from 'mint-ui';
    import EmptyData from '../Common/EmptyData.vue';
    import CommodityList from '../Common/CommodityList.vue';
    export default{
        props:{
            sortKey:{
                type:String,
                default:''
            }
        },
        components:{
            EmptyData,CommodityList
        },
        data(){
            return{
                data:[],
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
                vm.$http.post('/api/commodities/category',{
                    category_id : vm.$route.params.hashid
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
