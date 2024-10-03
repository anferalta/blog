<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;
use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;

class SiteControlador extends Controlador
{

    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    public function index(): void
    {
        $posts = (new PostModelo())->busca();
        
        echo $this->template->renderizar('index.html', [
            'posts' => $posts->resultado(true),
            'categorias' => $this->categorias(),
        ]);
    }

    public function buscar(): void
    {
        $busca = filter_input(INPUT_POST, 'busca', FILTER_DEFAULT);
        if (isset($busca)) {
            $posts = (new PostModelo())->busca("status = 1 AND titulo LIKE '%{$busca}%'")->resultado(true);
            
            if ($posts){
                foreach ($posts as $spost) {
                echo "<li class='list-group-item fw-bold'><a href=".Helpers::url('post/').$spost->id." class='text-white'>$post->titulo</a></li>";
                }
            }
        }
    }

    public function post(string $slug, int $id): void 

    {
        $post = (new PostModelo())->buscaPorId($id);
        if (!$post) {
            Helpers::redirecionar('404');
        }
        
        $post->salvarVisitas;

        echo $this->template->renderizar('post.html', [
            'post' => $post,
            'categorias' => $this->categorias(),
        ]);
    }

    public function categorias(): array
    {
        return (new CategoriaModelo())->busca("status = 1")->resultado(true);
    }

    public function categoria(string $slug): void
    {
        $categoria = (new CategoriaModelo())->buscaPorSlug($slug);
        if (!$categoria){
            Helpers::redirecionar('404');
        }
        
        $categoria->salvarVisitas();
        
        echo $this->template->renderizar('categoria.html', [
            'posts' => (new CategoriaModelo())->posts($categoria->id),
            'categorias' => $this->categorias(),
        ]);
    }

    public function sobre(): void
    {
        echo $this->template->renderizar('sobre.html', [
            'titulo' => 'sobre nós'
        ]);
    }

    public function erro404(): void
    {
        echo $this->template->renderizar('404.html', [
            'titulo' => 'Página não encontrada'
        ]);
    }
}
