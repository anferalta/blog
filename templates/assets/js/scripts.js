$(document).ready(function() {
    $("#busca").keyup(function () {
    var busca = $(this).val();
        if (busca.length > 0) {
            $.ajax({
                url: $('form').attr('data-url-busca'),
                method: 'POST',
                data: {
                    busca: busca
                },
                sucess: function (resultado) {
                    if (resultado) {
                        $('#buscaResultado').html("<div class='card'><div class='card-body'><ul class='list-group list-group-flush'>"+resultado+"</ul></div></div>");
                    }else {
                        $('$buscaResultado').html('<div class="alert alert-warning">Nenhum resultado encontrado!</div>');
                }
            }
        });
            $('#buscaResultado').show();
       }else {
           $('#buscaResultado').hide();
       }
    });
});