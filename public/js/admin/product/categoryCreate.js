$(function () {

    var $parentContainer = $('#parentWrapper');

    // 监听radio Change事件
    $('input[name="type"]').change(function(){
        var type = $(this).val();
        type === '1' ? $parentContainer.addClass('hidden') :$parentContainer.removeClass('hidden');
    });

});