$(document).ready(function() {
  $('#summernote').summernote();
});

//let table = new DataTable('#tabela');

$(document).ready(function() {
    $('#tabela').DataTable({
         language: {
            url:'//cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
        },
        processing: true,
        serverSide: true,
        ajax: 'http://localhost/blog/admin/posts/datatable'
    });
});

$(document).ready(function() {
    $('#tabelaCategorias').DataTable({
         language: {
            url:'//cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
        },
        order:[[1, 'asc']]
    });
});

$(document).ready(function() {
    $('#tabelaUsuarios').DataTable({
         language: {
            url:'//cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
        },
        order:[[1, 'asc']]
    });
});

