<template>
    <div class="container">
        <div class="draggable"></div>
    </div>
</template>

<style scoped>
.container {
  padding: 10px;
  border: 2px solid #F90;
  height: 200px;
}
.draggable {
  width: 140px;
  height: 140px;
  background: #F90;
  border-radius: 10px;
  margin: 0 10px 10px 0;
  float: left;
}
.draggable.is-pointer-down {
  background: #09F;
  z-index: 2; /* above other draggies */
}
.draggable.is-dragging { opacity: 0.7; }
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
            var $draggables = $('.draggable').draggabilly({
                // contain to parent element
                containment: true
            });
        }
    }
}
</script>
