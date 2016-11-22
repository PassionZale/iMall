<template>
    <index-banner></index-banner>
    <index-topic></index-topic>
    <index-plate></index-plate>
</template>

<script>
    import IndexBanner from './Index/IndexBanner.vue'
    import IndexTopic from './Index/IndexTopic.vue'
    import IndexPlate from './Index/IndexPlate.vue'

    export default{
        components:{
            IndexBanner, IndexTopic, IndexPlate
        }
    }

</script>