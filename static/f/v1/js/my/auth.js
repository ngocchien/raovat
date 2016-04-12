var Auth = {
    index: function () {
        $(document).ready(function () {
            $('.container .refresh').click(function () {
                Auth.captcha();
            });
            Auth.register();
            Auth.avatar();
            Auth.captcha();
        });
    },
    captcha: function () {
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: captchaURL,
                dataType: "json",
                success: function (result) {
                    $(".modal-body .captcha").attr('src', result);
                }
            })
        })
    },
    avatar: function () {
        $(document).ready(function () {
//            $('.author-avatar .upload').on('change', function () {
//                    console.log($(this).val());
//                });
            $('.author-avatar .upload').on('change', function (e) {
                if (this.disabled) {
                    return bootbox.alert('File upload not supported!')
                }
                ;
                var F = this.files;
                var data = new FormData();
                jQuery.each(jQuery('.author-avatar .upload')[0].files, function (i, file) {
                    data.append('file-' + i, file);
                });
                if (data != "") {
                    $.ajax({
                        url: changeAvatarUrl, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        dataType: 'json',
                        success: function (result) {
                            if (result.st == 1) {
                                $('.author-avatar .image-avatar').attr('src', result.images);
                            } else {
                                bootbox.alert('Xảy ra lỗi trong quá trình xử lý !');
                            }
                        }
                    });
                } else {
                    alert(data);
                }
            });
        })
    },
    register: function () {
        $(document).ready(function () {

        })
    },
//    avatar : function () {
//        $('.author-avatar .upload').on('change', function () {
//            console.log($(this).val());
//        });
//    }

};
