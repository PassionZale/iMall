$(function () {

    $('img').on('click', function () {
        $('#file').get(0).click();
    });

    $('#file').on('change', function () {
        $(this).removeClass('hidden').siblings('img').addClass('hidden');
    });
});
