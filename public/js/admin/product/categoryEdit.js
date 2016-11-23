$(function () {

    $('img').on('click', function () {
        $('#file').get(0).click();
    });

    $('#file').on('change', function () {
        $(this).removeClass('hidden').siblings('img').addClass('hidden');
    });

    var $parentContainer = $('#parentWrapper');

    // 监听radio Change事件
    $('input[name="type"]').change(radioHandler);

    var radioHandler = function(){
        var type = $('input[name="type"]:checked').val();
        type === '1' ? $parentContainer.addClass('hidden') :$parentContainer.removeClass('hidden');
    }

    radioHandler();

});