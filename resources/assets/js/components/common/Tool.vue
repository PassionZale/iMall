<template>
    <div class="container">
        <img id="tool" src="/images/icons/icon-tool.png"/>
    </div>
</template>

<style scoped>
.container {
  padding: 10px;
  border: 2px solid #F90;
  height: 500px;
}
#tool{
    display:block;
    width:24px;
    height:24px;
    border:1px solid #d7d7d7;
    background-color:#F90;
    border-radius:50%;
    float:left;
}
#tool.is-pointer-down {
  background: #09F;
  z-index: 999;
}
#tool.is-dragging { opacity: 0.7; }
</style>

<script>
export default{
    data(){
        return {
            historyRecord:[],
            title:'最近浏览过的商品'
        }
    },
    created(){
        // 初始化data
        this.initTool();
    },
    ready(){
        // 模版编译挂载后,初始化拖拽
        this.initDND();
    },
    methods:{
        initTool: function(){
            this.historyRecord = localStorage.getItem('historyRecord');
        },
        initDND: function(){
            let self = this;
            let $draggables = $('#tool').draggabilly({
                containment: true
            });
            $draggables.on('staticClick',function(event,pointer){
                self.showMask(event,pointer);
            });
        },
        showMask:function(){
            console.log(444);
        }
    }
}
</script>
