<?php

namespace sistema\Suporte;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Description of Email
 *
 * @author Administrador
 */

final class Email
{
    private PHPMailer $mail;
    private array $anexos;


    public function __construct()
    {
        $this->mail = new PHPMailer( true );
        
        $this->mail->isSMTP();                                            
        $this->mail->Host = 'anferalta-com.correoseguro.dinaserver.com'; 
        $this->mail->SMTPAuth = true; 
        $this->mail->Username = 'tony.almeida@anferalta.com'; 
        $this->mail->Password = '@nF1ralta24'; 
        $this->mail->SMTPSecure = PHPMailer :: ENCRYPTION_SMTPS;              
        $this->mail->Port = 465; 
        
        $this->mail-> setLanguage('pt_br');
        $this->mail-> CharSet = 'utf-8';
        $this->mail-> isHTML(true);
    }
    
    public function criar(
            string $assunto,
            string $conteudo,
            string $destinatarioEmail,
            string $destinatarioNome,
            ?string $responderEmail = null,
            ?string $responderNome = null
    ): static 
    {
        $this->mail->Subject = $assunto;
        $this->mail->Body = $conteudo;
        $this->mail->isHTML($conteudo);
        
        $this->anexos = [];
        
        $this->mail->addAddress($destinatarioEmail, $destinatarioNome);
        
        if ($responderEmail !== null && $responderNome !== null){
            $this->mail->addReplayTo($responderEmail, $responderNome);
        }
        
        return $this;
    }
    
    public function enviar(string $remetenteEmail, string $remetenteNome): bool
    {
        try {
            $this->mail->setFrom($remetenteEmail, $remetenteNome);
            
            foreach ($this->anexos as $anexo) {
                $this->mail->addAttachment($anexo['caminho'], $anexo['nome']);
            }
            
            $this->mail->send();
            return true;
            
        } catch (Exception $ex) {
            $ex = $this->mail->ErrorInfo();
            
            return false;
        }
    }
    
    public function anexar(string $caminho, ?string $nome = null): static 
    {
        $nome = $nome ?? basename($caminho);
        
        $this->anexos[] = [
            'caminho' => $caminho,
            'nome' => $nome
        ];
        
        return $this;
    }
}
