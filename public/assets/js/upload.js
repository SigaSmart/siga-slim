$(function () {
    $('form input[name="attachment"]').change(function () {
        var input = $(this);
        var target = $("#attachment");
        var fileDefault = target.attr('data-cover');
        if (!input.val()) {
            target.fadeOut('fast', function () {
                $(this).attr('src', fileDefault).fadeIn('slow');
            });
            return false;
        }
        if (this.files && (this.files[0].type.match("image/jpeg") || this.files[0].type.match("image/png"))) {
            var reader = new FileReader();
            reader.onload = function (e) {
                swal({
                    title: 'Your uploaded picture',
                    imageUrl: e.target.result,
                    imageAlt: 'The uploaded picture',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: 'Yes, subimet it!',
                    cancelButtonText: 'No, cancel!',                  
                    preConfirm: function () {
                        return new Promise(function (resolve, reject) {
                            var optionsUpload = {
                                success: function (responseText) {
                                    if (responseText.success) {
                                        target.fadeOut('fast', function () {
                                            $(this).attr('src', e.target.result).width('100%').fadeIn('fast');
                                        });
                                        message('The uploaded picture finished!', 'yuor file as beeen submitted: ', 'success',responseText.refresh);
                                    }
                                    if (responseText.error) {
                                        message('The uploaded picture!', 'as not submitted!', 'error',responseText.refresh);
                                    }
                                },
                                dataType: 'json',
                                type: 'POST'
                            };
                            $('#ajaxForm-upload').ajaxSubmit(optionsUpload);
                        });
                    },
                    allowOutsideClick: false
                })
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            target.fadeOut('fast', function () {
                $(this).attr('src', fileDefault).fadeIn('slow');
            });
            input.val('');
            return false;
        }
    });


})

