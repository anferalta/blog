<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;
use sistema\Modelo\PostModelo;
use sistema\Nucleo\Helpers;
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
            'posts' => $posts,
            'categorias' => (new CategoriaModelo())->busca(),
        ]);
    }

    public function buscar(): void
    {
        $busca = filter_input(INPUT_POST, 'busca', FILTER_DEFAULT);
        if (isset($busca)) {
            $posts = (new PostModelo())->pesquisa($busca);
            
            foreach ($posts as $spost) {
                echo "<li class='list-group-item fw-bold'><a href=".Helpers::url('post/').$spost->id." class='text-white'>$post->titulo</a></li>";
            }
        }
    }

    public function post(int $id): void
    {
        $post = (new PostModelo())->buscaPorId($id);
        if (!$post) {
            Helpers::redirecionar('404');
        }

        echo $this->template->renderizar('post.html', [
            'post' => $post
        ]);
    }

    public function categorias(): array
    {
        return (new CategoriaModelo())->busca();
    }

    public function categoria(int $id): void
    {
        $posts = (new CategoriaModelo())->posts($id);

        echo $this->template->renderizar('categoria.html', [
            'posts' => $posts
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
