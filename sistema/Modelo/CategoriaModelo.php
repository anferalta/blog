<?php

namespace sistema\Modelo;

use sistema\Nucleo\conexao;

/**
 * Description of PostModelo
 *
 * @author Administrador
 */

class CategoriaModelo
{
    public function busca(): array
    {
        $query = "SELECT * FROM categorias";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();
        
        return $resultado;
    }
    
    public function buscaPorId(int $id): bool|object
    {
        $query = "SELECT * FROM categorias WHERE id = {$id}";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();
        
        return $resultado;
    }
    
    public function armazenar(array $dados): void{
        $query="INSERT INTO `categorias` (`titulo`, `texto`, `status`) VALUES ?, ?, ?);";
        $stmt = conexao::getInstancia()->prepare($query);
        $stmt->execute([$dados['titulo'], $dados['texto'], $dados['status']]);
    }
}