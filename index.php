<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <?php
        //Arquivo index responsável pela inicialização do sistema
        require_once 'sistema/configuracao.php';
        include_once 'helpers.php';
        include './sistema/Nucleo/Mensagem.php';
        
        //$msg = new Mensagem();
        //echo $msg->scesso('Mensagem de sucesso')->renderizar();
        
        echo (new Mensagem())->erro('Mensagem de erro')->renderizar();
        echo '<hr>';
        
        ?>	
    </body>
</html>