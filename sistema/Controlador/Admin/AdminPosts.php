<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;
use sistema\biblioteca\Upload;

/**
 * Description of AdminPosts
 *
 * @author Administrador
 */

class AdminPosts extends AdminControlador
{
    private string $capa;

    public function datatable(): void
    {
        $datatable = $_REQUEST;
        $datatable = filter_var_array($datatable, FILTER_SANITIZE_STRING);
        
        $limite = $datatable['length'];
        $offset = $datatable['start'];
        $busca = $datatable['search']['value'];
        
        $colunas = [
            0 => 'id',
            2 => 'titulo',
            3 => 'categoria_id',
            4 => 'visitas',
            5 => 'status'
        ];
        
        $ordem = " ".$colunas[$datatable['order'][0]['column']]." ";
        $ordem .= " ".$datatable['order'][0]['dir']." ";
        
        $posts = new PostModelo();
        
        if (empty($busca)){
            $posts->busca()->ordem($ordem)->limite($limite)->offset($offset);
            $total = (new PostModelo())->busca(null, 'COUNT(id)', 'id')->total();
        } else {
            $posts->busca("id LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%' ")->limite($limite)->offset($offset);
            $total = $posts->total();
        }
         
        $dados = [];
        
        foreach ($posts->resultado(true) as $post) {
            $dados[] = [
                $post->id,
                $post->capa,
                $post->titulo,
                $post->categoria()->titulo ?? '-----',
                Helpers::formatarNumero($post->visitas),
                $post->status
              ];
        }
        
        $retorno = [
          "draw" => $datatable['draw'],
          "recordsTotal" => $total,
          "recordsFiltered" => $total,
          "data" => $dados  
        ];
        
        echo json_encode($retorno);
    }
    
    public function listar(): void
    {
        $post = new PostModelo();
        
            echo $this->template->renderizar('posts/listar.html', [
            //'posts' => $post->busca()->ordem('status ASC, titulo ASC')->resultado(true),
        
            'total' => [
                'posts' => 0,
                'postsAtivo' => 0,
                'postsInactivo' => 0
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
                $post->capa = $this->capa;
            
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
                
                if (!empty($_FILES['capa'])){
                    if ($post->capa && file_exists("uploads/imagens/{$post->capa}")){
                        unlink("uploads/imagens/{$post->capa}");
                    }
                    $post->capa = $this->capa;
                }
                            
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
                    
                    if ($post->capa && file_exists("uploads/imagens/{$post->capa}")){
                        unlink("uploads/imagens/{$post->capa}");
                    }
                    
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
                  
         if (!empty($_FILES['capa'])){
             $upload = new Upload();
             $upload->arquivo($_FILES['capa'], Helpers::slug($dados['titulo']), 'imagens');
             if ($upload->getResultado()){
                 $this->capa = $upload->getResultado();
             } else {
                 $this->mensagem->alerta($upload->getErro())->flash();
                 return false;
             }
         }
        
         return true;
        
    }
    
}
