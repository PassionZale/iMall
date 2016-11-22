$(function () {
    $('#menu-type-select').on('change', function () {
        var type = $(this).val();
        switch (type) {
            case '1':
                $('#menu-key').hide();
                $('#menu-url').show();
                break;
            case '2':
                $('#menu-key').show();
                $('#menu-url').hide();
                break;
            case '3':
                $('#menu-key,#menu-url').hide();
                break;
            default:
                $('#menu-key,#menu-url').hide();
                break;
        }
    });
});
