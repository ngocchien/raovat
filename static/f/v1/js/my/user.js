var User = {
    index: function () {
        $(document).ready(function () {
            $('.fa-upload').on('click', function () {
                $(this).prop('disabled', true);
                $('input[type=file]').trigger('click');
            })

            $("input[type=file]").change(function (e) {
                if (this.disabled) {
                    return bootbox.alert('File upload not supported!');
                }
                var F = this.files;
                var data = new FormData();
                jQuery.each(jQuery('input[type=file]')[0].files, function (i, file) {
                    data.append('file-' + i, file);
                });
                if (data != "") {
                    $.ajax({
                        url: changeAvatarURL, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        dataType: 'json',
                        beforeSend: function () {
                            $('#loading-mask').show();
                        },
                        success: function (rs)   // A function to be called if request succeeds
                        {
                            $('#loading-mask').hide();
                            if (rs.st == 1) {
                                $('.prod-images').attr('src', rs.images);
                                $('.fa-upload').prop('disabled', false);
                            } else {
                                $('.fa-upload').prop('disabled', false);
                                bootbox.alert(rs.ms);
                            }

                        }
                    });
                }
            });
        })
    },
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
    },
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