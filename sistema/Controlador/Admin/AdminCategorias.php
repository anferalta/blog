<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\PostModelo;
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
            'categorias' => $categorias->busca()->ordem('status ASC, id ASC')->resultado(true),
        
            'total' => [
                'total' => $categorias->total(),
                'activo' => $categorias->busca('status = 1')->total(),
                'inactivo' => $categorias->busca('status = 0')->total()
            ],
        ]);
    }
    
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)){
            
            $categorias = new CategoriaModelo();
                        
            $categorias->titulo = $dados['titulo'];
            $categorias->texto = $dados['texto'];
            $categorias->status = $dados['status'];
            
            if($categorias->salvar()){
                $this->mensagem->sucesso('Categoria cadastrada com sucesso')->flash();
                Helpers::redirecionar('admin/categorias/listar');
            }
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categorias'=> (new CategoriaModelo())->busca()]);
                
    }
    
    public function editar(int $id): void
    {
        $categorias = (new CategoriaModelo())->buscaPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)){
           
            $categorias = (new CategoriaModelo())->buscaPorId($id);
            
            $categorias->titulo = $dados['titulo'];
            $categorias->texto = $dados['texto'];
            $categorias->status = $dados['status'];
            
            if($categorias->salvar()){
                $this->mensagem->sucesso('Categoria atualizada com sucesso')->flash();
                Helpers::redirecionar('admin/categorias/listar');
            }
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categorias'=> (new CategoriaModelo())->busca()]);
    }
        
    public function deletar(int $id): void
    {
        if(is_int($id)){
            $categorias = (new CategoriaModelo())->buscaPorId($id);
            if (!$categorias){
                $this->mensagem->alerta('A categoria que voçê está tentando deletar não existe!')->flash();
                Helpers::redirecionar('admin/categorias/listar'); 
            } else {
                if($categorias->deletar()){
                    $this->mensagem->sucesso('Categoria deletada com sucesso!')->flash();
                    Helpers::redirecionar('admin/categorias/listar'); 
                } else {
                    $this->mensagem->erro($categorias->erro())->flash();
                    Helpers::redirecionar('admin/categorias/listar'); 
                }
            }
        }
    }
    
}
