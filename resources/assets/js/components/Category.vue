<template>
    <div id="categories-content-left">
        <ul>
            <li v-for="category in categories"
                @click="showSubCategories(category)"
                :class="{'active':activeCategory == category.parent_category.id}">
                <span>{{category.parent_category.category_name}}</span>
            </li>
        </ul>
    </div>
    <div id="categories-content-right">
        <ul>
            <li v-for="sub_category in subCategories" v-link="{name:'aCategory',params:{'hashid':sub_category.id}}">
                <img :src="sub_category.category_img" />
                <h4>{{sub_category.category_name}}</h4>
            </li>
        </ul>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                categories:'',
                searchKey:'',
                subCategories:'',
                activeCategory:''
            }
        },
        created(){
            this.fetchCategories();
        },
        methods:{
            fetchCategories:function(){
                let vm = this;
                vm.$http.get('/api/categories').then(function(response){
                    vm.$set('categories',response.data);
                    vm.$nextTick(function(){
                        vm.showSubCategories(vm.categories[0]);
                    });
                });
            },
            showSubCategories:function(category){
                this.$set('activeCategory',category.parent_category.id)
                this.$set('subCategories',category.sub_categories);
            }
        }
    }

</script>