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
}
