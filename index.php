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
        
        require 'vendor/autoload.php';
        
        $document = new \Bissolli\ValidadorCpfCnpj\CPF('123.456.789.00');
        
        var_dump($document->isValid());
        
        ?>	
    </body>
</html>