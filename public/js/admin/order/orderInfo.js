$(function () {

    $('.info-btn').on('click', function (e) {
        e.preventDefault();
        var orderId = $(this).attr('data-order');
        $.get('order/' + orderId, function (response) {
            $('#data-table').empty().append($(response));
            $('#orderModal').modal('show');
        });
    });


});