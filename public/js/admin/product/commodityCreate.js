$(function () {
    var placeholder = '======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。';
    var $textarea = $('textarea[name="commodity_base_info"]');
    $textarea.val(placeholder);
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
});