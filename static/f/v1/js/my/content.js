var Content = {
    index: function () {
        $(document).ready(function () {
            Content.add();
            $(".list-image .delete-images").on("click",function(){
                $('.list-image').attr('hidden','hidden');
                $('.img-prod .main-images').val('');
                $('.upload_file').removeAttr('hidden');
            });
        });
    },
    
    add: function(){
        $(document).ready(function () {
            var cateID = $('#detail .category').val();
            console.log(cateID);
            if(cateID!=''){
                $.ajax({
                    type: "POST",
                    url: propURL,
                    dataType: "json",
                    data: {
                        'cateID': cateID,
                    },
                    success: function (result) {
                        if(result.st==1){
                            $('#detail .properties').html(result.data);
                        }else{
                            return fales;
                        }
                    }
                });
            }
            $('#detail .category').on('change',function(){
                cateID = $(this).val();
                if(cateID!=''){
                    $.ajax({
                        type: "POST",
                        url: propURL,
                        dataType: "json",
                        data: {
                            'cateID': cateID,
                        },
                        success: function (result) {
                            if(result.st==1){
                                $('#detail .properties').html(result.data);
                            }else{
                                return fales;
                            }
                        }
                    });
                }
            })
            
            $(".file").change(function (e) {
                if (this.disabled)
                    return bootbox.alert('File upload not supported!');
                var F = this.files;
//                console.log(F);
//                if (F && F[0])
//                    for (var i = 0; i < F.length; i++)
//                        readImage(F[i]);
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
                        dataType:'json',
                        success: function (result)   // A function to be called if request succeeds
                        {
                            if(result.st==1){
                                $('.upload_file').attr('hidden','hidden');
                                $('.list-image').removeAttr('hidden');
                                $(".list-image .view-images").attr("href",result.sourceImage);
                                $('.img-prod .prod-images').attr('src',result.images);
                                $('.img-prod .main-images').val(result.data);
                                $(".list-image .delete-images").on("click",function(){
                                    $('.list-image').attr('hidden','hidden');
                                    $('.img-prod .main-images').val('');
                                    $('.upload_file').removeAttr('hidden');
                                });
                            }else{
//                                bootbox.alert(result.ms);
                            }
                           
                        }
                    });
                }
            });
            
        });
    },
};
