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
    public function ler(): array
    {
        $query = "SELECT * FROM `posts`";
        $stmt = conexao::getInstancia()->query($query);
        
        $resultado = $stmt->fetchAll();
        
        return $resultado;
    }
}
