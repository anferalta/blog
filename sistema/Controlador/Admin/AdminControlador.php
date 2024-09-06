<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;

/**
 * Description of AdminControlador
 *
 * @author Administrador
 */
class AdminControlador extends Controlador
{
    public function __construct()
    {
        parent::__construct('templates/admin/views');
        
        $usuario = false;
        
        if(!$usuario){
            $this->mensagem->erro('Faça login para acessar o painel de controle!')->flash();
            
            Helpers::redirecionar('admin/login');
        }
    }
}


