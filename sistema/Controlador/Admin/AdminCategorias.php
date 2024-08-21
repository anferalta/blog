<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

/**
 * Description of AdminCategorias
 *
 * @author Administrador
 */

class AdminCategorias extends AdminControlador
{
    public function listar(): void
    {
        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => (new CategoriaModelo())->busca()
        ]);
    }
           
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            (new CategoriaModelo())->armazenar($dados);
            Helpers::redirecionar('admin/categorias/listar');
        }
        echo $this->template->renderizar('categorias/formulario.html', [
            'categorias'=> (new CategoriaModelo())->busca()]);
        
    }
    
     public function editar(int $id): void
    {
        $categorias = (new CategoriaModelo())->buscaPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            (new CategoriaModelo())->atualizar($dados, $id);
            Helpers::redirecionar('admin/categorias/listar');
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria' => $categorias
    ]);     
    }
}
