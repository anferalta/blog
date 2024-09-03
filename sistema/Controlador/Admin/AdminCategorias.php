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
        $categorias = new CategoriaModelo();
        
        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => $categorias->busca()->ordem('status ASC, ID DESC')->resultado(true), 
            'total' => [
                'total' => $categorias->total(),
                'activo' => $categorias->total('status = 1'),
                'inactivo' => $categorias->total('status = 0')
            ]
        ]);
    }
           
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            (new CategoriaModelo())->armazenar($dados);
            $this->mensagem->sucesso('Categoria adicionada com sucesso')->flash();
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
            $this->mensagem->alerta('Categoria atualizada com sucesso')->flash();
            Helpers::redirecionar('admin/categorias/listar');
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria' => $categorias
    ]);     
    }
    
    public function deletar(int $id): void
    {
        (new CategoriaModelo())->deletar($id);
        $this->mensagem->alerta('Categoria deletada com sucesso')->flash();
            Helpers::redirecionar('admin/categorias/listar'); 
    }
}
