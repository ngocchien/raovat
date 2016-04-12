

$(document).ready(function () {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('#loginForm .userlogin,#loginForm .passwordlogin,#loginForm .remember').keypress(function (event) {
        if (event.which == 13) {
            $('.btnlogin').trigger('click');
        }
    });

    $('#resetpassForm .userlogin,#resetpassForm .captcha').keypress(function (event) {
        if (event.which == 13) {
            $('.btnrspass').trigger('click');
        }
    });

    $('#formRegister .fullname,#formRegister .email,#formRegister .password,#formRegister .repassword,#formRegister .userphone').keypress(function (event) {
        if (event.which == 13) {
            $('.btnRegister').trigger('click');
        }
    });

    $('#loginButton').on('click', function () {
        if (bootbox) {
            bootbox.hideAll();
        }

        bootbox
                .dialog({
                    title: '<b>Đăng Nhập</b>',
                    message: $('#loginForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function () {
                    $('#loginForm').show();
                })
                .on('hide.bs.modal', function (e) {
                    $('#loginForm').hide().appendTo('body');
                })
                .modal('show');
    });

    $('#loginRegister').on('click', function () {
        if (bootbox) {
            bootbox.hideAll();
        }
        bootbox
                .dialog({
                    title: '<b>Đăng ký thành viên</b>',
                    message: $('#formRegister'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function () {
                    $('#formRegister').show();
                })
                .on('hide.bs.modal', function (e) {
                    $('#formRegister').hide().appendTo('body');
                })
                .modal('show');
    });

    $('#loginForm .reset-password').on('click', function () {
        Captcha();
        $('#loginForm').hide().appendTo('body');

        if (bootbox) {
            bootbox.hideAll();
        }
        bootbox
                .dialog({
                    title: '<b>Lấy lại mật khẩu</b>',
                    message: $('#resetpassForm'),
                    show: false, // We will show it manually later
                })
                .on('shown.bs.modal', function () {
                    $('#resetpassForm').show();
                })
                .on('hide.bs.modal', function (e) {
                    $('#resetpassForm').hide().appendTo('body');
                })
                .modal('show');
    });

    $('#loginForm .btnlogin').click(function () {
        $('.error-login-password').hide();
        $('.error-login-email').hide();
        $('.error-login').hide();
        var strUsername = $('#loginForm .userlogin').val();
        var strPassWord = $('#loginForm .passwordlogin').val();
        var remember = $('#loginForm .remember').is(':checked');
        if (strUsername == '') {
            $('.error-login-email').show();
        }
        if (strPassWord == '') {
            $('.error-login-password').show();
        }
        if (strUsername && strPassWord) {
            $.ajax({
                type: "POST",
                url: loginURL,
                dataType: "json",
                data: {
                    'strUsername': strUsername,
                    'strPassWord': strPassWord,
                    'remember': remember
                },
                success: function (result) {
                    if (result.st == 1) {
                        window.parent.location = window.parent.location
                    } else {
                        $('#loginForm .error-login').show();
                        $('#loginForm .error-login').html('<b style="color:red">' + result.ms + '</b>');
                    }
                }
            })
        }
    });

    $('#resetpassForm .btnrspass').click(function () {
        $('.error-forgot').hide();
        $('.error-forgot-email').hide();
        $('.error-forgot-captcha').hide();
        var strUsername = $('#resetpassForm .userlogin').val();
        var strCaptcha = $('#resetpassForm .captcha').val();
        if (strUsername == '') {
            $('.error-forgot-email').show();
        }
        if (strCaptcha == '') {
            $('.error-forgot-captcha').show();
        }
        if (strUsername && strCaptcha) {
            $.ajax({
                type: "POST",
                url: resetpassURL,
                dataType: "json",
                data: {
                    'user_email': strUsername,
                    'captcha': strCaptcha,
                },
                success: function (result) {
                    if (result.st == 1) {
                        if (bootbox) {
                            bootbox.hideAll();
                        }
                        bootbox.alert(result.ms, function () {

                        });
                    } else {
                        $('#resetpassForm .error-forgot').show();
                        $('#resetpassForm .error-forgot').html('<b style="color:red">' + result.ms + '</b>');
                    }
                }
            })
        }
    });

    $('#formRegister .btnRegister').click(function () {
        $('.error-register-fullname').hide();
        $('.error-register-email').hide();
        $('.error-register-password').hide();
        $('.error-register-repassword').hide();
        $('.error-register-phone').hide();
        $('.error-register-fullname').hide();
        $('.error-register-fullname').hide();
        $('.error-register').hide();

        var strFullname = $('#formRegister .fullname').val();
        var strEmail = $('#formRegister .email').val();
        var strPassword = $('#formRegister .password').val();
        var strRePassword = $('#formRegister .repassword').val();
        var strUserphone = $('#formRegister .userphone').val();
        var errors = 0;

        if (strFullname.length < 4) {
            $('.error-register-fullname').show();
            errors = errors + 1;
        }

        if (strPassword.length < 6) {
            $('.error-register-password').show();
            errors = errors + 1;
        }

        if (strPassword != '' && strRePassword != strPassword) {
            $('.error-register-repassword').show();
            errors = errors + 1;
        }

        if (!IsEmail(strEmail)) {
            $('.error-register-email').show();
            errors = errors + 1;
        }
        if (!validatePhone(strUserphone)) {
            $('.error-register-phone').show();
            errors = errors + 1;
        }

        if (errors == 0) {
            $.ajax({
                type: "POST",
                url: registerURL,
                dataType: "json",
                data: {
                    'user_fullname': strFullname,
                    'user_password': strPassword,
                    're_user_password': strRePassword,
                    'user_email': strEmail,
                    'user_phone': strUserphone
                },
                success: function (result) {
                    if (result.st == 1) {
                        if (bootbox) {
                            bootbox.hideAll();
                        }
                        bootbox.alert(result.ms, function () {
                            window.parent.location = window.parent.location;
                        })

                    } else {
                        $('.error-register').show();
                        $('.error-register').html('<b style="color:red">' + result.ms + '</b>');
                    }
                }
            })
        }
    });

    function Captcha() {
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: captchaURL,
                dataType: "json",
                success: function (result) {
                    $(".modal-dialog .img-captcha, .comment .img-captcha").attr('src', result.url);
                }
            });
        });
    }
    ;

    IsEmail = function (strEmail) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(strEmail);
    };
    validatePhone = function (txtPhone) {
        var filter = /^[0-9-+]+$/;
        if (filter.test(txtPhone)) {
            if (txtPhone.length < 8 || txtPhone.length > 12) {
                return false;
            }
            return true;
        } else {
            return false
        }
    };
    $('.fa-refresh').click(function () {
        Captcha();
    });

});
