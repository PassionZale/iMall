<template>
    <div class="container">
        <img id="tool" src="/images/icons/icon-tool.png"/>
        <div id="mask" v-show="show">

        </div>
    </div>
</template>

<style scoped>
.container {
  border: 1px solid #F90;
  height: 500px;
}
#tool{
    display:block;
    width:24px;
    height:24px;
    border:1px solid #d7d7d7;
    background-color:#F90;
    border-radius:50%;
    z-index:900;
    top:50px;
    left:0;
}
#tool.is-pointer-down {
  background: #09F;
}
#tool.is-dragging { opacity: 0.7; }
#mask{
    height:500px;
    width:100%;
    position:fixed;
    top:0;
    z-index:800;
    opacity:0.3;
    filter: alpha(opacity=30);
    background-color:#000;
}
</style>

<script>
export default{
    data(){
        return {
            clientWidth:'',
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
            this.clientWidth = $('body').width();
            this.historyRecord = localStorage.getItem('historyRecord');
        },
        initDND: function(){
            let self = this;
            let $dnd = $('#tool').draggabilly({
                containment: true
            });
            // TOOL ICON staticClick event
            $dnd.on('staticClick', function(event, pointer){
                self.show = !self.show;
            });
            // TOOL ICON dragEnd event
            $dnd.on('dragEnd', function(event, pointer){
                if(pointer.pageX <= self.clientWidth/2){
                    $(pointer.target).css({left:0,float:'left'});
                }else{
                    $(pointer.target).css({left:0,float:'right'});
                }
            });
        },
        showMask:function(event,pointer){
            this.show = !this.show;
        }
    }
}
</script>
