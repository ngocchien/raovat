var Content = {
    add: function () {
        $(document).ready(function () {
            $('#detail .category').on('change', function () {
                __changeCategory();
            })

            $('.list-image .delete-images').on('click', function () {
                $(this).closest('.img-prod').remove();
            })

            $(".file").change(function (e) {
                var total = 0;
                $('.list-image .img-prod').each(function () {
                    total += 1;
                })
                if (total >= 5) {
                    bootbox.alert('Max file upload is 5!');
                    return false;
                }
                if (this.disabled)
                    return bootbox.alert('File upload not supported!');
                var F = this.files;
                var data = new FormData();
                jQuery.each(jQuery('.file')[0].files, function (i, file) {
                    data.append('file-' + i, file);
                });
                if (data != "") {
                    $.ajax({
                        url: UploadURL, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        dataType: 'json',
                        success: function (result)   // A function to be called if request succeeds
                        {
                            if (result.st == 1) {
                                $('.list-image').show();
                                $('.list-image').append(result.html);
                                $('.list-image .delete-images').on('click', function () {
                                    $(this).closest('.img-prod').remove();
                                })

                            } else {
                                bootbox.alert(result.ms);
                            }

                        }
                    });
                }
            });

        });
    },
    detail: function () {
        $(document).ready(function () {
            Captcha();

            $('.refresh-captcha').on('click', function () {
                Captcha();
            });

            $('.add-comment').on('click', function () {
                $('.comment-error-name').hide();
                $('.comment-error-email').hide();
                $('.comment-error-content').hide();
                $('.comment-error-captcha').hide();
                var full_name = $('input[name=full_name]').val();
                var email = $('input[name=email]').val();
                var comment_content = $('textarea[name=comment-content]').val();
                var cont_id = $('input[name=cont_id]').val();
                var captcha = $('input[name=captcha]').val();
                var error = 0;

                if (!full_name || full_name.length < 5) {
                    $('.comment-error-name').html('Nhập Họ và tên không hợp lệ!');
                    $('.comment-error-name').show();
                    error += 1;
                }

                if (!IsEmail(email)) {
                    $('.comment-error-email').html('Địa chỉ email không hợp lệ!');
                    $('.comment-error-email').show();
                    error += 1;
                }

                if (!comment_content || comment_content.length < 10) {
                    $('.comment-error-content').html('Nội dung phản hồi phải từ 10 ký tự trở lên!');
                    $('.comment-error-content').show();
                    error += 1;
                }

                if (!captcha || captcha.length != 6) {
                    $('.comment-error-captcha').html('Nhập mã xác nhận chưa chính xác!');
                    $('.comment-error-captcha').show();
                    error += 1;
                }

                if (error == 0) {
                    $.ajax({
                        type: 'POST',
                        url: addCommentURL,
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $('#loading-mask').show();
                        },
                        data: {
                            full_name: full_name,
                            email: email,
                            comment_content: comment_content,
                            cont_id: cont_id,
                            captcha: captcha
                        },
                        success: function (rs) {
                            $('#loading-mask').hide();
                            if (rs.st == 1) {
                                bootbox.alert(rs.ms);
                                Captcha();
                                $('textarea[name=comment-content]').val('');
                                $('input[name=captcha]').val('');
                                $('.comment-list-post').prepend(rs.html);
                            } else {
                                var html = '<div class="">';
                                $.each(rs.errors, function (k, v) {
                                    var temp = '<p style="color:red"> <b> - ' + v + '</b></p>'
                                    html += temp;
                                })
                                html += '</div>';
                                bootbox.alert(html);
                            }
                        }
                    });
                }
            });

            //save content
            $('a.save-post').on('click', function () {
                if (!cont_id) {
                    bootbox.alert('<p style="color:red"><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</b></p>', function () {
                        return false;
                    });
                }
                $.ajax({
                    type: 'POST',
                    url: saveContentURL,
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {
                        $('#loading-mask').show();
                    },
                    data: {
                        cont_id: cont_id
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        bootbox.alert(rs.ms, function () {
                        });
                    }
                });
            });

            $('a.up-vip').on('click', function () {

            });

            $('a.modal-messages').on('click', function () {
                $('#ModalSendMessages').modal('toggle');
            });

            $('button.send-messages').on('click', function () {
                $('.error-messages').hide();
                var messages_content = $(this).closest('.modal-content').find('#message-text').val();
                if (messages_content.length < 10) {
                    $('.error-messages').html('Nội dung tin nhắn phải từ 10 ký tự trở lên!');
                    $('.error-messages').show();
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: sendMessagesURL,
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {
                        $('#ModalSendMessages').modal('hide');
                        $('#loading-mask').show();
                    },
                    data: {
                        cont_id: cont_id,
                        messages_content: messages_content
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        $('#message-text').val('');
                        bootbox.alert(rs.ms, function () {

                        });
                    }
                });

            });

            $('.no-login').on('click', function () {
                bootbox.alert('<p style="color:red"><b>Vui lòng đăng nhập trước khi thực hiện thao tác này!</b></p>');
            });

            $('a.modal-confirm-pass').on('click', function () {
                $('#confirm-pass-cont').modal('toggle');
            });

            $('.send-pass-content').on('click', function () {
                $('.error-pass-content').hide();
                if (!cont_id) {
                    bootbox.alert('<p style="color:red"><b>Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</b></p>', function () {
                        return false;
                    });
                }

                var pass_content = $('#pass-content').val();
                var error = false;

                if (!pass_content) {
                    error = true;
                    $('.error-pass-content').html('Bạn chưa nhập mật khẩu của tin này!');
                    $('.error-pass-content').show();
                }

                if (error == false) {
                    $.ajax({
                        type: 'POST',
                        url: confirmPassContURL,
                        dataType: 'json',
                        cache: false,
                        beforeSend: function () {
                            $('#loading-mask').show();
                        },
                        data: {
                            cont_id: cont_id,
                            cont_pass: pass_content
                        },
                        success: function (rs) {
                            $('#loading-mask').hide();
                            if (rs.st == 1) {
                                window.location.href = rs.url;
                            } else {
                                bootbox.alert(rs.ms);
                                return false;
                            }
                        }
                    });
                }
            })
        })
    }
};

function __changeCategory() {
    var cateID = $('#detail .category').val();
    if (cateID != 0) {
        $.ajax({
            type: "POST",
            url: propURL,
            dataType: "json",
            data: {
                'cateID': cateID,
            },
            success: function (result) {
                if (result.st == -1) {
                    bootbox.alert(result.ms, function () {
                        return false;
                    });
                } else {
                    var html = '<option value="0">Chọn nhu cầu</option>';
                    if (result.st == 1) {
                        $.each(result.data, function (k, v) {
                            html += '<option value="' + v.prop_id + '">' + v.prop_name + '</option>'
                        });
                        $('div.select-properties').show();
                        $('select.properties').html(html);
                    } else {
                        $('select.properties').html(html);
                        $('div.select-properties').hide();
                    }
                }
            }
        });
    } else {
        var html = '<option value="0">Chọn nhu cầu</option>';
        $('select.properties').html(html);
        $('div.select-properties').hide();
    }
}
;

function __valid(els) {
    var count = 1;
    els.each(function () {
        $(this).html(count);
        count++;
    });
}

function loadCaptcha() {

}