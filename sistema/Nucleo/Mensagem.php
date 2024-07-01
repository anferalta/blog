<?php

/**
 * @author T A <john.doe@example.com>
 */
class Mensagem
{
    private $texto;
    private $css;
    
    
    /**
     * Metodo responsabilizado pela renderização
     * @return string
     */
    public function renderizar() : string
    {
        return $this->texto = $this->filtrar('<h1>mensagen de teste');  
    }
    
    private function filtrar(string $mensagem) : string
    {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }        
    
}
