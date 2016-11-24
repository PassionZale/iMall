$(function () {

    var treeData = [];

    $.get('/admin/product/getTreeData', function (response) {
        $.each(response, function (index, item) {
            var obj = {text:'',nodes:[]};
            obj.text = item.parent_category.category_name;
            $.each(item.sub_categories,function(i,val){
                obj.nodes.push({text:val.category_name});
            });
            treeData[index] = obj;
        });
        initTree(treeData);
    });

    function initTree(data){
        $('#tree').treeview({
            data: data,
            selectable: true,
            levels:2,
        });
    }

});