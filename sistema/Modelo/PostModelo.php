<?php

namespace sistema\Modelo;

use sistema\Nucleo\conexao;

/**
 * Description of PostModelo
 *
 * @author Administrador
 */
class PostModelo
{
    public function busca(): array
    {
        $query = "SELECT * FROM posts";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function buscaPorId(int $id): bool|object
    {
        $query = "SELECT * FROM posts WHERE id = {$id}";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }
    
    public function pesquisa(string $busca): array
    {
        $query = "SELECT * FROM posts WHERE status = 1 AND titulo LIKE '%{busca}%' ";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();
        
        if (isset($busca)) {
            $posts = (new PostModelo())->pesquisa($busca['busca']);

        return $resultado;
        }
    }

//return $resultado;
}

   