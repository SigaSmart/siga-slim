$(function () {
    var options = {
        target: '#output', // target element(s) to be updated with server response 
        beforeSubmit: showRequest, // pre-submit callback 
        success: showResponse, // post-submit callback 

        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        type: 'post', // 'get' or 'post', override for form's 'method' attribute 
        dataType: 'json' // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                //resetForm: true        // reset the form after successful submit 

                // $.ajax options can be used here too, for example: 
                //timeout:   3000 
    };

    // bind to the form's submit event 
    $('.ajaxForm').submit(function () {
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options);

        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false;
    });

    // bind to the form's submit event 
    $('.ajaxFormHtml').ajaxForm({
        // target identifies the element(s) to update with the server response 
        target: '#output',
        beforeSend: function () {
            $('#output').html('<p><p><div class="col-md-12"><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>');
        },
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function () {
            $('#output').fadeIn('slow');
        }
    });


});


// pre-submit callback 
function showRequest(formData, jqForm, options) {
    return true;
}

// post-submit callback 
function showResponse(responseText, statusText, xhr, $form) {
    if (responseText.inputs) {
        $.each(responseText.inputs, function (i, value) {
            document.getElementById(i).value = value;
        });
    }
    $(".real").formatCurrency();
    message(responseText.title, responseText.msg, responseText.type, responseText.refresh);
}

function getMoney(str)
{
    return parseInt(str.replace(/[\D]+/g, ''));
}
function formatReal(int)
{
    var tmp = int + '';
    tmp = tmp.replace(".", "").replace(",", ".");
    return tmp;
}
function number_format(number, decimals, dec_point, thousands_sep)
{
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}