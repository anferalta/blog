$(document).ready(function() {
  $('#summernote').summernote();
});

//let table = new DataTable('#tabela');

$(document).ready(function() {
    $('#tabela').DataTable({
         language: {
            url:'//cdn.datatables.net/plug-ins/2.1.8/i18n/pt-BR.json'
        }
    });
});