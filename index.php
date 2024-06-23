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
        
        echo saudacao().' hoje é '.dataAtual();

        //$meses = array();
       // $meses = [
         // 'j' => 'Janeiro', 
           // 'Fevereiro', 
           // 'Março'];
        //foreach ($meses as $chave){
          //  echo $chave.'<br>';
        //}
        //echo $meses[0];
        //echo '<hr>';
        //var_dump($meses);
        
        //echo '<hr>';
       // echo $_SERVER['SCRIPT_FILENAME'];
        //echo '<hr>';
        //var_dump($_SERVER);
        
        ?>	
    </body>
</html>