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

    var editor = new wangEditor('editor');
    editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
        if (item === 'source') {
            return null;
        }
        if(item === 'bgcolor'){
            return null;
        }
        if(item === '|'){
            return null;
        }
        if (item === 'emotion') {
            return null;
        }
        if(item === 'location'){
            return null;
        }
        if(item === 'insertcode'){
            return null;
        }
        return item;
    });
    editor.config.menuFixed = false;
    editor.config.uploadImgUrl = '/admin/product/editorUpload';
    editor.config.uploadParams = {
        _token: $('input[name="_token"]').val()
    };
    editor.config.uploadImgFileName = 'editorFile';
    editor.create();

});