<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

/**
 * Description of AdminPosts
 *
 * @author Administrador
 */

class AdminPosts extends AdminControlador
{
    public function listar(): void
    {
        $post = new PostModelo();
        
            echo $this->template->renderizar('posts/listar.html', [
            'posts' => $post->busca()->ordem('status ASC, titulo ASC')->resultado(true),
        
            'total' => [
                'total' => $post->total(),
                'activo' => $post->busca('status = 1')->total(),
                'inactivo' => $post->busca('status = 0')->total()
            ],
        ]);
    }
    
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)){
            
            if ($this->validarDados($dados)){
                $post = new PostModelo();
                 
                $post->usuario_id = $this->usuario->id;
                $post->categoria_id = $dados['categoria_id'];
                $post->slug = Helpers::slug($dados['titulo']);
                $post->titulo = $dados['titulo'];
                $post->texto = $dados['texto'];
                $post->status = $dados['status'];
            
                if($post->salvar()){
                    $this->mensagem->sucesso('Post cadastrado com sucesso')->flash();
                    Helpers::redirecionar('admin/posts/listar');
                }else {
                        $this->mensagem->erro($post->erro())->flash();
                        Helpers::redirecionar('admin/posts/cadastrar'); 
                        }
        }
            
    }
        
        echo $this->template->renderizar('posts/formulario.html', [
            'categorias'=> (new CategoriaModelo())->busca()]);
                
    }
    
       
    public function editar(int $id): void
    {
        $post = (new PostModelo())->buscaPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)){
            if ($this->validarDados($dados)) {
                $post = (new PostModelo())->buscaPorId($id);
                
                $post->usuario_id = $this->usuario->id;
                $post->categoria_id = $dados['categoria_id'];
                $post->slug = Helpers::slug($dados['titulo']);
                $post->titulo = $dados['titulo'];
                $post->texto = $dados['texto'];
                $post->status = $dados['status'];
                $post->atualizado_em = date('Y-m-d H:i:s');
                            
            if($post->salvar()){
                $this->mensagem->sucesso('Post atualizado com sucesso')->flash();
                Helpers::redirecionar('admin/posts/listar');
            }else {
                    $this->mensagem->erro($post->erro())->flash();
                    Helpers::redirecionar('admin/posts/cadastrar');
                    }
            }
        }
        
        echo $this->template->renderizar('posts/formulario.html', [
            'post'=> $post
        ]);
    }
    
    public function deletar(int $id): void
    {
        if(is_int($id)){
            $post = (new PostModelo())->buscaPorId($id);
            if (!$post){
                $this->mensagem->alerta('O post que voçê está tentando deletar não existe!')->flash();
                Helpers::redirecionar('admin/posts/listar'); 
            } else {
                if($post->deletar()){
                    $this->mensagem->sucesso('Post deletado com sucesso!')->flash();
                    Helpers::redirecionar('admin/posts/listar'); 
                } else {
                    $this->mensagem->erro($post->erro())->flash();
                    Helpers::redirecionar('admin/posts/listar'); 
                }
            }
        }
    }
    
     public function validarDados(array $dados): bool
    {
        
        if (empty($dados['titulo'])){
            if (!Helpers::validarSenha($dados['titulo'])){
                $this->mensagem->alerta('Informe titulo do post!')->flash();
                
                return false;
            }
        }
        
        if (empty($dados['texto'])){
            if (!Helpers::validarSenha($dados['texto'])){
                $this->mensagem->alerta('Informe o texto do post!')->flash();
                
                return false;
            }
        }
        
        return true;
        
    }
    
}
