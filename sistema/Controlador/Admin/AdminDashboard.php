<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Sessao;
use sistema\Nucleo\Helpers;

/**
 * Description of AdminDashboard
 *
 * @author Administrador
 */

class AdminDashboard extends AdminControlador
{
    public function dashboard(): void
    {
        echo $this->template->renderizar('dashboard.html', []);
    }
    
    public function sair(): void
    {
        $sessao = new Sessao();
        $sessao->limpar('usuarioId');
        
        $this->mensagem->informa('Voçê saiu do Painel de Controle!')->flash();
        Helpers::redirecionar('admin/login');
    }
}
