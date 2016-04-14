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
                                    console.log('xxxxx');
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
