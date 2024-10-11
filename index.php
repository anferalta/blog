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
        use sistema\Biblioteca\Upload;
        
        $upload = new Upload('upload');
        
        var_dump($upload);
        
        if (!empty($arquivo = $_FILES)){
            $arquivo = $_FILES['arquivo'];
            $upload->arquivo($arquivo, 'novo nome', 'imagens');
            if ($upload->getResultado()){
                echo 'Upload feito com sucesso do arquivo '.$upload->getResultado();
            } else {
                echo $upload->getErro();
            }
            r($upload);
        }
         
        echo '<hr>';
        ?>
        
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="arquivo">
            <button>Enviar</button>
        </form>

</html>