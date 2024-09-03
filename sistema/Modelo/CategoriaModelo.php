<?php

namespace sistema\Modelo;

use sistema\Nucleo\conexao;
use sistema\Nucleo\Modelo;

/**
 * Description of PostModelo
 *
 * @author Administrador
 */

class CategoriaModelo extends Modelo
{
    const TABELA = 'categorias';
    
    public function __construct()
    {
        parent::__construct('categorias');
    }


    public function buscaPorId(int $id): bool|object
    {
        $query = "SELECT * FROM ". self::TABELA." WHERE id = {$id}";
        $stmt = conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();
        
        return $resultado;
    }
    
    //public function armazenar(array $dados): void
    //{
     //   $query="INSERT INTO categorias (`titulo`, `texto`, `status`) VALUES (?, ?, ?);";
       // $stmt = conexao::getInstancia()->prepare($query);
        //$stmt->execute([$dados['titulo'], $dados['texto'], $dados['status']]);
    //}
    
   // public function atualizar(array $dados, int $id): void
    //{
     //   $query = "UPDATE categorias SET titulo = ?, texto = ?, status = ? WHERE id = {$id} ";
       // $stmt = conexao::getInstancia()->prepare($query);
        //$stmt->execute([$dados['titulo'], $dados['texto'], $dados['status']]);
    //}
    
    public function deletar(int $id): void
    {
        $query = "DELETE FROM categorias WHERE id = {$id} ";
        $stmt = conexao::getInstancia()->prepare($query);
        $stmt->execute();
    }
    
    public function total(?string $termo = null): int
    {
        $termo = ($termo ? "WHERE {$termo}" : '' );
        
        $query = "SELECT * FROM categorias {$termo} ";
        $stmt = conexao::getInstancia()->prepare($query);
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}