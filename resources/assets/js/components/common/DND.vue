<template>
    <img  v-show="dnd.show"  id="dnd-icon" src="/images/icons/icon-tool.png"/>
    <div  v-show="mask.show"  id="dnd-mask" @click="toggleMask()">

    </div>
</template>

<script>
export default{
    data(){
        return {
            dnd:{
               show:true
            },
            mask:{
                show:false
            }
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

        },
        initDND: function(){
            let self = this;
            let $dnd = $('#dnd-icon').draggabilly({
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
            this.dnd.show = !this.dnd.show;
            this.mask.show = !this.mask.show;
        }
    }
}
</script>
