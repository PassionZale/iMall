$(function () {
    // 更新指定粉丝信息
    $('.refresh-btn').on('click', function (e) {
        e.preventDefault();
        var $self = $(this);
        var openid = $self.attr('data-openid');
        $.get('/admin/wechat/refresh?openid=' + openid, function (response) {
            console.log(response);
        });
    });
});
