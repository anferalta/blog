<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>index</title>
    </head>
    <body>

        <?php
        //Arquivo index responsavel pela inicialização do sistema

        require 'vendor/autoload.php';
        //require 'rotas.php';     
        
        $session = new sistema\Nucleo\Sessao();
        
        //$session->criar('nome', 'Antonio Almeida');
        var_dump($session->carregar());
        echo '<hr>';
        var_dump($session->checar('nome'));
        echo '<hr>';
        //$session->limpar('usuario');
        //var_dump($session->checar('usuario'));
        echo '<hr>';
        $session->deletar();
        
        ?>	

</html>