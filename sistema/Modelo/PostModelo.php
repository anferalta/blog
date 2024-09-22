<?php

namespace sistema\Modelo;

use sistema\Nucleo\conexao;
use sistema\Nucleo\Modelo;

/**
 * Description of PostModelo
 *
 * @author Administrador
 */
class PostModelo extends Modelo
{

    public function __construct()
    {
        parent::__construct('posts');
    }
    
    public function categoria(): ?CategoriaModelo
    {
        if ($this->categoria_id){
            return (new CategoriaModelo())->buscaPorId($this->categoria_id);
        }
    }

}





   