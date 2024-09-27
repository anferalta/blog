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
    
    public function usuario(): ?UsuarioModelo
    {
        if ($this->categoria_id){
            return (new UsuarioModelo())->buscaPorId($this->usuario_id);
        }
        return null;
    }
    
    public function salvar(): bool
    {
        $this->slug();
        return parent::salvar();
    }

}





   