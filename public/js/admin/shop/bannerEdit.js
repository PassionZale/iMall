requirejs(['jquery', 'bootstrap', 'metisMenu'], function ($) {
    $(function () {
        $('#menu').metisMenu({toggle: false});

        $('img').on('click',function(){
            $('#file').get(0).click();
        });

        $('#file').on('change',function(){
            $(this).removeClass('hidden').siblings('img').addClass('hidden');
        });
    });
});
