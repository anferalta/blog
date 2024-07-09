<?php

namespace sistema\Controlador;

use sistema\Suporte\Template;

class SiteControlador extends Controlador
{
    public function __construct(string $diretorio)
    {
        parent::__construct('templates/site/views');
    }
    public function index():void
    {
        echo $this->template->renderizar('index.html', ['titulo' => 'teste de titulo', 'subtitulo' => 'teste de subtitulo']);
    } 
    
    public function sobre(): void
    {
        echo 'página sobre';
    }
}
