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
    listMessages: function () {
        $(document).ready(function () {
            $('.read-messages').on('click', function () {
                var id = $(this).attr('rel');
                if (!id) {
                    bootbox.alert('Xảy ra lỗi trong quá trình xử lý!');
                }
                var that = $(this);
                $.ajax({
                    type: 'POST',
                    url: getMessagesURL,
                    cache: false,
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    beforSend: function () {
                        $('#loading-mask').show();
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        if (rs.st == 1) {
                            if (rs.data.is_active == true) {
                                var totalNew = $('.total-new').attr('rel');
                                var newNumber = totalNew - 1;
                                if (newNumber > 0) {
                                    $('.total-new').attr('rel', newNumber);
                                    $('.total-new').html('(' + newNumber + ' tin nhắn mới)');
                                } else {
                                    $('.total-new').html('');
                                }
                            }
                            that.closest('tr').removeClass('unread');
                            bootbox.dialog({
                                message: rs.html,
                                title: "Nội dung tin nhắn",
                                buttons: {
                                    success: {
                                        label: "OK",
                                        className: "btn-success",
                                        callback: function () {
                                        }
                                    },
                                    main: {
                                        label: "Gửi phản hồi",
                                        className: "btn-primary",
                                        callback: function () {
                                            $('#recipient-name').val(rs.data.from_user_name);
                                            $('#recipient-email').val(rs.data.from_user_email);
                                            $('#mess-id').val(rs.data.mess_id);
                                            bootbox.hideAll();
                                            $('#modalSendMessages').modal('toggle');
                                        }
                                    }
                                }
                            });
                        } else {
                            bootbox.alert(rs.ms);
                        }
                    }
                });
            });

            $('.btn-send-messages').on('click', function () {
                $('.valid-title').hide();
                $('.valid-content').hide();
                var mess_content = $('#message-text').val();
                var mess_title = $('#title').val();
                var mess_id = $('#mess-id').val();
                console.log(mess_id);
                if (!mess_id) {
                    bootbox.alert('<p stype="color:red">Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát!</p>', function () {
                        return;
                    });
                }
                var error = 0;
                if (!mess_id) {
                    error += 1;
                    bootbox.alert('Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát');
                }

                if (mess_content.length < 20) {
                    error += 1;
                    $('.valid-content').html('Nội dung tin nhắn phải từ 20 ký tự trở lên!');
                    $('.valid-content').show();
                }

                if (mess_title.length < 10) {
                    error += 1;
                    $('.valid-title').html('Tiêu đề tin nhắn phải từ 10 ký tự trở lên!');
                    $('.valid-title').show();
                }

                if (error == 0) {
                    $.ajax({
                        type: 'POST',
                        url: replayMessagesURL,
                        dataType: 'json',
                        cache: false,
                        data: {
                            mess_id: mess_id,
                            mess_title: mess_title,
                            mess_content: mess_content
                        },
                        beforeSend: function () {
                            $('#loading-mask').show();
                        },
                        success: function (rs) {
                            $('#loading-mask').hide();
                            $('#modalSendMessages').modal('toggle');
                            bootbox.alert(rs.ms);
                        }
                    })
                }
            });

            $('.check-all').on('click', function () {
                var isCheck = $(this).is(':checked');
                $('tbody .item').each(function (e, v) {
                    $(this).prop('checked', isCheck);
                })
            });

            $('.btn-delete-all').on('click', function () {
                var arrItem = [];
                var that = $(this);
                $('tbody .item').each(function () {
                    var isCheck = $(this).is(':checked');
                    if (isCheck == true) {
                        var item = $(this).val();
                        arrItem.push(item)
                    }
                })
                if (arrItem.length === 0) {
                    bootbox.alert('Vui lòng chọn tin cần xóa');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: deleteMessagesURL,
                    dataType: 'json',
                    cache: false,
                    data: {
                        arrItem: arrItem
                    },
                    beforeSend: function () {
                        $('#loading-mask').show();
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        if (rs.st == 1) {
                            bootbox.alert(rs.ms);
                            $.each(rs.data, function (k, v) {
                                $('#item-' + v).remove();
                            })
                        } else {
                            bootbox.alert(rs.ms)
                        }
                    }
                })
            })


        })
    },
    listPost: function () {
        $(document).ready(function () {

            $('.check-all').on('click', function () {
                var isCheck = $(this).is(':checked');
                $('tbody .content-item').each(function (e, v) {
                    $(this).prop('checked', isCheck);
                })
            });

            $('.remove-all').on('click', function () {
                var arrItem = [];
                $('tbody .content-item').each(function () {
                    var isCheck = $(this).is(':checked');
                    if (isCheck == true) {
                        var item = $(this).val();
                        arrItem.push(item)
                    }
                })

                if (arrItem.length === 0) {
                    bootbox.alert('Vui lòng chọn tin cần xóa!');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: deletePostURL,
                    dataType: 'json',
                    cache: false,
                    data: {
                        arrItem: arrItem,
                        type: 'delete-all'
                    },
                    beforeSend: function () {
                        $('#loading-mask').show();
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        if (rs.st == 1) {
                            bootbox.alert(rs.ms);
                            $.each(rs.data, function (k, v) {
                                $('#item-' + v).remove();
                            })
                        } else {
                            bootbox.alert(rs.ms)
                        }
                    }
                })
            })

            $('.remove').on('click', function () {
                var cont_id = $(this).attr('rel');
                var that = $(this);
                if (!cont_id) {
                    bootbox.alert('Xảy ra lỗi trong quá trình xử lý! Vui lòng thử lại sau giây lát');
                    return false;
                }
                bootbox.confirm('Bạn có chắc chắn muốn xóa rao vặt này không???', function (e) {
                    if (e) {
                        $.ajax({
                            type: 'GET',
                            url: deletePostURL,
                            cache: false,
                            dataType: 'json',
                            data: {
                                cont_id: cont_id
                            },
                            beforeSend: function () {
                                $('#loading-mask').show();
                            },
                            success: function (rs) {
                                $('#loading-mask').hide();
                                if (rs.st == 1) {
                                    bootbox.alert(rs.ms);
                                    that.closest('tr').remove();
                                } else {
                                    bootbox.alert(rs.ms);
                                    return false;
                                }
                            }
                        });
                    }
                })
            })
        });
    },
    listSavePost: function () {
        $(document).ready(function () {
            $('.check-all').on('click', function () {
                var isCheck = $(this).is(':checked');
                $('tbody .content-item').each(function (e, v) {
                    $(this).prop('checked', isCheck);
                })
            });
            $('.remove-all').on('click', function () {
                var arrItem = [];
                $('tbody .content-item').each(function () {
                    var isCheck = $(this).is(':checked');
                    if (isCheck == true) {
                        var item = $(this).val();
                        arrItem.push(item)
                    }
                })

                if (arrItem.length === 0) {
                    bootbox.alert('Vui lòng chọn tin cần xóa!');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: deleteSavePostURL,
                    dataType: 'json',
                    cache: false,
                    data: {
                        arrItem: arrItem,
                        type: 'delete-all'
                    },
                    beforeSend: function () {
                        $('#loading-mask').show();
                    },
                    success: function (rs) {
                        $('#loading-mask').hide();
                        if (rs.st == 1) {
                            bootbox.alert(rs.ms);
                            $.each(rs.data, function (k, v) {
                                $('#item-' + v).remove();
                            })
                        } else {
                            bootbox.alert(rs.ms)
                        }
                    }
                })
            })
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