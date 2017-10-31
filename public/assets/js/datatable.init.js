$(function () {

    if (typeof options !== 'undefined') {
        var defaultOptions = {
            "processing": true,
            "serverSide": true,
            "ajax": "api/cidades",
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }

        };
        var dataTable = $('#datTable').DataTable($.extend(defaultOptions, options));

    }

    //DELETE CONFIRM
    $('#datTable').on('click', '.dt_delete_action', function (e) {
        var RelTo = $(this);
        if (RelTo.hasClass('btn-danger')) {
            RelTo.addClass('btn-warning').removeClass('btn-danger');
        } else {
            $.get(RelTo.attr('href'), function (data) {
                dataTable.row(RelTo.parents('tr')).remove().draw();
            }, 'json');
        }
        window.setTimeout(function () {
            RelTo.addClass('btn-danger').removeClass('btn-warning');
        }, 5000);
        e.preventDefault();
        e.stopPropagation();
    });

    //DELETE CONFIRM
    $('#datTable').on('click', '.ativar', function (e) {
        var RelTo = $(this);
        $.get(RelTo.children('a').attr('href'), function (data) {
            dataTable.draw();
        }, 'json');
        e.preventDefault();
        e.stopPropagation();
    });

});