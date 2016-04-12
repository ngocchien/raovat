var Comment = {
    index: function () {
        $(document).ready(function () {
            Comment.add();
        });

        function IsEmail(Email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(Email);
        }
        ;
    },
    add: function () {
        $(document).ready(function () {
            $(".comment-list-post .item").each(function (i, tag) {
                $(tag).find('.btn-reply').click(function () {
                    $(tag).find("#form-comment").show();
                })
            });

            $(".col-md-8 #form-comment").each(function (i, tag) {
                $(tag).find('.btncomment').click(function () {
                    strFullname = $(tag).find('.full-name').val();
                    strEmail = $(tag).find('.email').val();
                    strParent = $(this).attr('parent');
                    strCommentContent = $(tag).find('.comment-content').val();
                    errors = '';
                    if (!IsEmail(strEmail)) {
                        errors = errors + 'Địa chỉ Email không đúng định dạng !<br/>';
                    }
                    if (strFullname.length < 3) {
                        errors = errors + 'Nhập Họ và tên chưa chính xác ! <br/>';
                    }
                    if (strCommentContent.length < 3) {
                        errors = errors + 'Nội dung bình luận phải từ 3 kí tự trở lên ! <br/>';
                    }
                    if (!ProdID) {
                        errors = errors + 'Xảy ra lỗi trong quá trình xử lý!<br/>';
                    }
                    if (errors != '') {
                        bootbox.alert('<b style="color:red">' + errors + '<b>');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: commentURL,
                            dataType: "json",
                            data: {
                                'strFullname': strFullname,
                                'strEmail': strEmail,
                                'strCommentContent': strCommentContent,
                                'ProdID': ProdID,
                                'strParent': strParent
                            },
                            success: function (result) {
//                                console.log(result.parent);die;
                                if (result.st == 1) {
                                    if (result.parent != 0) {
                                        $(tag).find('.comment-content').val('');
                                        $('.item-' + result.parent).append(
                                                '<article class="row">' +
                                                '<div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">' +
                                                '<figure class="thumbnail">' +
                                                '<img class="img-responsive" src="' + result.data.user_avatar + '">' +
                                                '</figure>' +
                                                '</div>' +
                                                '<div class="col-md-9 col-sm-9">' +
                                                '<div class="panel panel-default arrow left">' +
                                                '<div class="panel-heading right">Phản hồi</div>' +
                                                '<div class="panel-body">' +
                                                '<header class="text-left">' +
                                                '<div class="comment-user"><i class="fa fa-user"></i> ' + result.data.user_fullname + '</div>' +
                                                '<time class="comment-date"><i class="fa fa-clock-o"></i> ' + result.data.time + '</time>' +
                                                '</header>' +
                                                '<div class="comment-post">' +
                                                '<p>' + result.data.comm_content + '</p>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '</div>' +
                                                '</article>'
                                                );
                                    } else {
                                        $(tag).find('.comment-content').val('');
                                        $('.comment-list-post').prepend(
                                            '<article class="row">' +
                                            '<div class="col-md-2 col-sm-2 hidden-xs">' +
                                            '<figure class="thumbnail">' +
                                            '<img class="img-responsive" src="'+ result.data.user_avatar +'">' +
                                            '<figcaption class="text-center"></figcaption>' +
                                            '</figure>' +
                                            '</div>' +
                                            '<div class="col-md-10 col-sm-10">' +
                                            '<div class="panel panel-default arrow left item">' +
                                            '<div class="panel-body">' +
                                            '<header class="text-left">' +
                                            '<div class="comment-user"><i class="fa fa-user"></i> ' + result.data.user_fullname + '</div>' +
                                            '<time class="comment-date"><i class="fa fa-clock-o"></i> '+ result.data.time +'</time>' +
                                            '</header>' +
                                            '<div class="comment-post">' +
                                            '<p>'+ result.data.comm_content +'</p>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</article>'
                                            );
                                    }
                                } else {
                                    bootbox.alert('<b style="color:red">' + result.ms + '<b>');
                                }
                            }
                        });
                    }
                    // alert(strFullname);
                });
            });
        });
    },
};
