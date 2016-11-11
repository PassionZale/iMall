<template>
    <img id="tool" src="/images/icons/icon-tool.png"/>
    <div id="mask" v-show="show" @click="toggleMask()">

    </div>
</template>

<script>
export default{
    data(){
        return {
            historyRecord:[],
            title:'最近浏览过的商品',
            show:false
        }
    },
    created(){
        this.initTool();
    },
    ready(){
        // 模版编译挂载后,注册对应拖拽事件监听
        this.initDND();
    },
    methods:{
        initTool: function(){
            this.historyRecord = localStorage.getItem('historyRecord');
        },
        initDND: function(){
            let self = this;
            let $dnd = $('#tool').draggabilly({
                containment: true,
            });
            // TOOL ICON staticClick event
            $dnd.on('staticClick', function(event, pointer){
                self.toggleMask();
            });
            // TOOL ICON dragEnd event
            $dnd.on('dragEnd', function(event, pointer){
                $(pointer.target).css({left:5});
            });
        },
        toggleMask:function(){
            this.show = !this.show;
        }
    }
}
</script>
