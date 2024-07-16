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
        
        use sistema\Nucleo\conexao;
        
        $con = conexao::getInstancia();
        
        //echo SITE_NOME;
        //echo sistema\Nucleo\Helpers::saudacao();             
                 
        ?>	
    </body>
</html>