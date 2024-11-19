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

        use sistema\Suporte\Email;
        
        try{
            
            $email = new Email();
            $email->criar('Assunto do Email', 'Conteudo do email <b>negrito</b> ', 'tony.almeida@anferalta.com', 'Tóny Almeida', 'tialeila@gmail.com', 'Tia Leila');
            
            $email->anexar('./uploads/teste.txt');
            $email->anexar('./uploads/arquivo.pdf', 'PDF');
            
            $email->enviar('tony.almeida@anferalta.com', 'Anferalta');
            echo 'Email enviado com sucesso!';
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
               
        ?>

</html>