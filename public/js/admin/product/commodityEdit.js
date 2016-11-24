$(function () {
    var placeholder = '======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。';
    var $textarea = $('textarea[name="commodity_base_info"]');

    $textarea.focus(function () {
        if ($(this).val() === placeholder) {
            $(this).val('');
        }
    });
    $textarea.blur(function () {
        if ($(this).val() === '') {
            $(this).val(placeholder);
        }
    });

    $('img').on('click', function () {
        $('#file').get(0).click();
    });

    $('#file').on('change', function () {
        $(this).removeClass('hidden').siblings('img').addClass('hidden');
    });

});