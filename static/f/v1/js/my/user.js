var User = {
    captcha: function () {
        $(document).ready(function () {
            _getCaptcha();
            $('.fa-refresh').on('click', function () {
                _getCaptcha();
            });

            $('form').submit(function () {
                $('.btn-primary').prop("disabled", true);
                $('#loading-mask').show();
            });
        });
    }
};

function _getCaptcha() {
    $.ajax({
        type: "POST",
        url: captchaURL,
        dataType: "json",
        success: function (result) {
            $(".img-captcha").attr('src', result.url);
        }
    })
}