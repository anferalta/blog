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
        
        echo slug("Adão \"Negro\" - '2020' "). '<hr>';  
        echo slug("Avatar 2: O caminho da Águia"). '<hr>';
        echo slug("Não! Não Olhe!"). '<hr>';
        echo slug("Sonic 2 - O Filme"). '<hr>';
        echo slug("Nova Serie no Disney+!"). '<hr>';
        echo slug("100 Melhores Filmes"). '<hr>';
        echo slug("teste!@###$%6''%%'',*.:/?\|,");
        
        ?>	
    </body>
</html>