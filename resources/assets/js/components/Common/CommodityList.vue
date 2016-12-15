<template>
    <div id="list-data-container">
        <div v-for="item in list" class="list-data-wrapper" v-link="{name:'commodity',params:{hashid:item.id}}">
            <img :src="item.commodity_img" alt="item.commodity_name"/>
            <div class="data-info-wrapper">
                <p class="title">
                    {{item.commodity_name}}
                </p>
                <p class="price">
                    &yen;{{item.commodity_current_price}}&emsp;<del>&yen;{{item.commodity_original_price}}</del>
                    <span>剩余：{{item.commodity_stock_number}}件</span>
                </p>
            </div>
        </div>
    </div>

</template>

<script>
    export default{
        props:{
            list:{
                type: Array,
                twoWay: true,
                default:function(){
                    return {
                        data:[]
                    };
                }
            }
        }
    }
</script>
