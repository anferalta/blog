<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        //Arquivo index responsável pela inicialização do sistema
        require_once 'sistema/configuracao.php';
        include_once 'helpers.php';
        include './sistema/Nucleo/Mensagem.php';
        
        $msg = new Mensagem();
        echo $msg->renderizar();
        echo '<hr>';
        var_dump($msg);
        
        ?>	
    </body>
</html>