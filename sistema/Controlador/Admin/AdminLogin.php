<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;
use sistema\Modelo\UsuarioModelo;


/**
 * Description of AdminControlador
 *
 * @author Administrador
 */
class AdminLogin extends Controlador
{
    public function __construct()
    {
        parent::__construct('templates/admin/views');
        
    }
    
    public function login(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (isset($dados)){
            if (in_array('', $dados)){
                $this->mensagem->alerta('Todos os campos são obrigatórios!')->flash();
           }else {
                $usuario = (new UsuarioModelo())->login($dados, 3);
                
                if($usuario){
                    Helpers::redirecionar('admin/login');
                }
            }
        }
    
        echo $this->template->renderizar('login.html', []);
    }
}


