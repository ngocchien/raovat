var Content = {
    index: function () {
        $(document).ready(function () {
            $('.remove').click(function () {
                var categoryId = $(this).attr('rel');
                if (!categoryId) {
                    bootbox.alert('Xảy ra lỗi trong quá trình xử lý! Vui lòng refresh lại trình duyệt và thử lại!');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    url: baseurl + '/backend/category/delete',
                    data: {
                        categoryId: categoryId
                    },
                    success: function (rs) {
                        if (rs.st == 1) {
                            bootbox.alert(rs.ms, function () {
                                window.location = window.location.href;
                            });
                        } else {
                            bootbox.alert(rs.ms);
                        }
                    }
                });
            });
        });
        Content.add();
    },
    
    add : function(){
        $(document).ready(function(){
            $('.wysihtml5').wysihtml5();
        })
    },
}