$(function () {

    var treeData = [];

    var _token = $('input[name="_token"]').val();

    $.get('/admin/product/getTreeData', function (response) {
        $.each(response, function (index, item) {
            var obj = {text: '', nodes: []};
            obj.text = item.parent_category.category_name;
            $.each(item.sub_categories, function (i, val) {
                obj.nodes.push({text: val.category_name});
            });
            treeData[index] = obj;
        });
        initTree(treeData);
    });

    function initTree(data) {
        $('#tree').treeview({
            data: data,
            selectable: true,
            levels: 2
        });

        var lastSelectedNodeId = '';

        $('#tree').on('nodeSelected', function (event, data) {
            if (lastSelectedNodeId !== data.nodeId) {
                lastSelectedNodeId = data.nodeId;
                $.get('/admin/product/getTableData', {
                    name: data.text
                }, function (response) {
                    var html = '<tbody>';
                    $.each(response,function(index,item){
                        var str = '<tr>';
                        str += '<td><img class="commodity-img-url" src="' + item.commodity_img+'"/></td>';
                        str += '<td>' + item.commodity_name+'</td>';
                        str += '<td>&yen;' + item.commodity_current_price+'</td>';
                        str += '<td>' + item.commodity_stock_number+'</td>';
                        str += '<td>' + item.commodity_sold_number+'</td>';
                        str += '<td>' + item.commodity_disabled+'</td>';
                        str += '<td>' + item.commodity_sort+'</td>';
                        str += '<td>';
                        str += '<a class="edit-btn" title="修改" href="/admin/product/commodity/'+item.id+'/edit">修改</a>';
                        str += '<form method="post" class="del-form" action="/admin/product/commodity/'+item.id+'">';
                        str += '<input type="hidden" name="_method" value="DELETE">';
                        str += '<input type="hidden" name="_token" value="'+_token+'">';
                        str += '<button title="删除" type="submit" class="del-btn">删除</button>';
                        str += '</form>';
                        str += '</td>';
                        html += str;
                    });
                    html += '</tbody>';
                    $('tbody').remove();
                    $(html).appendTo($('table'));
                });
            } else {
                return false;
            }
        });

    }

});