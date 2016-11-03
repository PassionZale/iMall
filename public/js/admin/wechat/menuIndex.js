requirejs(['jquery', 'bootstrap', 'metisMenu'], function ($) {
    $(function () {
        $('#menu').metisMenu({toggle: false});
        $('#push-menu-btn').click(function () {
            $('#push-menu-form').submit();
        });
    });
});
