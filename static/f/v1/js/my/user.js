var User = {
    captcha: function () {
        $(document).ready(function () {
            _getCaptcha();
            $('.fa-refresh').on('click', function () {
                _getCaptcha();
            })

        });

        $('form#form-recharge').submit(function () {
            $(this).find('button[type=submit]').prop('disabled', true);
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