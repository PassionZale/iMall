<template>
    <index-banner></index-banner>
    <index-topic></index-topic>
</template>

<script>
    import IndexBanner from './Index/IndexBanner.vue'
    import IndexTopic from './Index/IndexTopic.vue'
    export default{
        data(){
            return {
            }
        },
        components:{
            IndexBanner, IndexTopic
        }
    }
</script>