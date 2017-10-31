$(function () {
    swal.setDefaults({
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger'
    });

    $('.action-delete').click(function (event) {
        var input = $(this);
        swal.queue([{
                title: 'Deseja realmente excluir o item selecionado?',
                text: 'Click no botão Confirmar para finalizar!',
                confirmButtonText: 'Confirmar',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    $.get(input.attr('href'))
                            .done(function (data) {
                                if (data.result) {
                                    input.parent(document.getElementById(data.id)).fadeOut('fast', function () {
                                        $(this).parent().parent().remove();
                                    });
                                }
                                message(data.title, data.msg, data.type, data.refresh);
                            });
                }
            }]);
        return event.preventDefault();
    });
    if (typeof selectURL !== 'undefined') {

// Initialize ajax autocomplete:
        $('#busca').autocomplete({
            serviceUrl: selectURL,
            onSelect: function (suggestion) {
                $('#id').val(suggestion.data.id);
            }
        });

        $("#wwwwww").select2({
            //theme: "bootstrap",
            ajax: {
                url: selectURL,
                data: function (params) {
                    return {
                        name: params.term
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    return {
                        results: data.map(function (busca) {
                            return {id: busca.id, text: busca.name};
                        })
                    };
                }
            }

        });
    }
    $(".real").blur(function ()
    {
        $(".real").formatCurrency();
    });
    $(".real").formatCurrency();

});
function message(title, msg, type, refresh) {
    swal({
        title: title,
        text: msg,
        type: type,
        onClose: function () {
            if (!refresh) {
                window.location.reload();
            }
        }}
    );
}