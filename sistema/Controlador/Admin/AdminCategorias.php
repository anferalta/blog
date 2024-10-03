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
            'categorias' => $categorias->busca()->ordem('status ASC, titulo ASC')->resultado(true),
        
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
            if ($this->validarDados($dados)) {
                
                if(empty($dados['titulo'])){
                    $this->mensagem->alerta('Informe o titulo da categoria')->flash(); 
                } else {
                        $categorias = new CategoriaModelo();
                        
                        $categorias->titulo = $dados['titulo'];
                        $categorias->texto = $dados['texto'];
                        $categorias->status = $dados['status'];
                        $categorias->cadastrado_em = date('Y-m-d H:i:s');
                    }
            
                        if($categorias->salvar()){
                            $this->mensagem->sucesso('Categoria cadastrada com sucesso')->flash();
                            Helpers::redirecionar('admin/categorias/listar');
                        }else {
                        $this->mensagem->erro($usuario->erro())->flash();
                        Helpers::redirecionar('admin/categorias/cadastrar'); 
                        }
            }
            
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria'=> $dados
        ]);
                
    }
    
    public function editar(int $id): void
    {
        $categoria = (new CategoriaModelo())->buscaPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)){
            if ($this->validarDados($dados)) {
                $categoria = (new CategoriaModelo())->buscaPorId($id);
                
                $categoria->titulo = $dados['titulo'];
                $categoria->texto = $dados['texto'];
                $categoria->status = $dados['status'];
                $categoria->actualizado_em = date('Y-m-d H:i:s');
                            
            if($categoria->salvar()){
                $this->mensagem->sucesso('Categoria atualizada com sucesso')->flash();
                Helpers::redirecionar('admin/categorias/listar');
            }else {
                    $this->mensagem->erro($categoria->erro())->flash();
                    Helpers::redirecionar('admin/categorias/cadastrar');
                    }
            }
        }
        
        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria'=> $categoria
        ]);
    }
    
    public function validarDados(array $dados): bool
    {
        if (empty($dados['titulo'])){
            $this->mensagem->alerta('Informe o titulo da categoria')->flash();
            return false;
        }
        if (empty($dados['texto'])){
            $this->mensagem->alerta('Informe o texto da categoria')->flash();
            return false;
        }
        
        return true;
        
    }
        
    public function deletar(int $id): void
    {
        if(is_int($id)){
            $categoria = (new CategoriaModelo())->buscaPorId($id);
            if (!$categoria){
                $this->mensagem->alerta('A categoria que voçê está tentando deletar não existe!')->flash();
                Helpers::redirecionar('admin/categorias/listar'); 
            } else {
                if($categoria->deletar()){
                    $this->mensagem->sucesso('Categoria deletada com sucesso!')->flash();
                    Helpers::redirecionar('admin/categorias/listar'); 
                } else {
                    $this->mensagem->erro($categoria->erro())->flash();
                    Helpers::redirecionar('admin/categorias/listar'); 
                }
            }
        }
    }
    
}
