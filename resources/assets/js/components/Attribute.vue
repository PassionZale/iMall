<template>
    <div id="sequence-container">
        <ul>
            <li :class="{'active' : sortKey === 'timeDown'}" @click="sortByTime()">新品</li>
            <li :class="{'active' : sortKey === 'soldDown'}" @click="sortBySold()">畅销</li>
            <li :class="{'active' : sortKey === 'priceUp' || sortKey === 'priceDown'}" @click="sortByPrice()">
                价格&nbsp;
                <span v-show="sortKey === 'priceUp'">&and;</span>
                <span v-show="sortKey === 'priceDown'">&or;</span>
            </li>
        </ul>
    </div>
    <router-view :sort-key="sortKey"></router-view>
</template>

<script>
    export default{
        data(){
            return{
                sortKey:'',
                commodities:''
            }
        },
        methods:{
            sortByTime:function(){
                this.$set('sortKey','timeDown');
            },
            sortBySold:function(){
                this.$set('sortKey','soldDown');
            },
            sortByPrice:function(){
                if(this.sortKey !== 'priceUp'){
                    this.$set('sortKey','priceUp');
                }else{
                    this.$set('sortKey','priceDown');
                }
            }
        }
    }


</script>
