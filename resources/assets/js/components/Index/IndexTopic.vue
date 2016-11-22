<template>
    <mt-navbar>
        <mt-tab-item id="{{topic.topic_title}}" v-for="topic in topics">
            <img slot="icon" :src="topic.topic_img">
            {{topic.topic_title}}
        </mt-tab-item>
    </mt-navbar>
</template>
<style scoped>

</style>
<script>
    import { Navbar, TabItem } from 'mint-ui';
    export default{
        data(){
            return{
                topics:''
            }
        },
        components:{
            Navbar, TabItem
        },
        ready(){
            this.fetchTopic();
        },
        methods:{
            fetchTopic:function(){
                let vm = this;
                this.$http.get('/api/topics').then(function(response){
                    vm.$set('topics',response.data);
                });
            }
        }
    }
</script>
