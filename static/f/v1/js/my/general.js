var General = {
    addContat: function () {
        $(document).ready(function () {
            Captcha();
            $('.refresh-captcha').on('click', function () {
                Captcha();
            });
        })
    },
}