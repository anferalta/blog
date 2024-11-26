$(document).ready(function () {
    $('#summernote').summernote();
});

//let table = new DataTable('#tabela');

$(document).ready(function () {

    var url = $('table').attr('url');

    $.extend($.fn.dataTable.defaults, {
        language: {
            url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
        }
    });

    $('#tabela').DataTable({
        ajax: {
            url: url + 'admin/posts/datatable',
            type: 'POST',
            error: function (xhr, resp, text) {
                alert('Sua busca não retornou nenhum resultado!');
                //console.log(xhr, resp, text);
            }
        },
        order: [[0, 'desc']],
        processing: true,
        serverSide: true,
        columns: [
            null,
            {
                data: null,
                render: function (data, type, row) {
                    if (row[1]) {
                        return '<a data-fancybox data-caption="capa" class="overflow zoom"\n\
        href="' + url + 'uploads/imagens/' + row[1] + '"><img src=" ' + url + 'uploads/imagens/thumbs/' + row[1] + ' " /><a/>';
                    } else {
                        return '<i class="fa-regular fa-images fs-1 text-secondary"></i>';
                    }
                }
            },
            null, null, null,
            {
                data: null,
                render: function (data, type, row) {
                    if (row[5] === 1) {
                        return '<i class="fa-solid fa.circle text-sucess" tooltip="tooltip" title="Ativo"></i>';
                    } else {
                        return '<i class="fa-solid fa.circle text-danger" tooltip="tooltip" title="Inativo"></i>';
                    }
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    var html = '';

                    html += ' a href=" ' + url + '/posts/editar/' + row[0] + ' " tooltip="tooltip"\n\
 title="Editar"><i class="fa-solid fa-pen m-1"></i></a> ';

                    html += ' a href=" ' + url + '/posts/deletar/' + row[0] + ' " ><i class="fa-solid fa-trash m-1"></i></a> ';

                    return html;
                }

            }
        ]

    });
    
    $(document).ready(function () {
        $('#tabelaCategorias').DataTable({
           order: [[1, 'asc']] 
        });
    });

    $(document).ready(function () {
        $('#tabelaUsuarios').DataTable({
            order: [[1, 'asc']]
        });
    });
});
