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

        $cpf = '004.348.491-38';
        
        var_dump(validarCPF($cpf));
        //echo $limparNumero = preg_replace('/[^0-9]/', ' ', $cpf);

        //for ($t = 9; $t < 11; $t++) {
        //    for ($d = 0, $c = 0; $c < $t; $c++) {
        //        $d += $cpf[$c] * (($t + 1) - $c);
        //    }
        //    $d = ((10 * $d) % 11) % 10;
        //    if ($cpf[$c] != $d) {
        //        echo 'CPF INVÁLIDO';
        //    } else {
        //        echo 'CPF VÁLIDO';
        //    }
        //}
        
        ?>	
    </body>
</html>