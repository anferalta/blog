<?php

namespace sistema\biblioteca;

/**
 * Description of upload
 *
 * @author Administrador
 */
class Upload
{   
    private $directorio;
    private $arquivo;
    private $nome;
    private $subDirectorio;


    public function __construct(string $directorio = null)
    {
        $this->directorio = $directorio ?? 'uploads';
        
        if (!file_exists($this->directorio) && !is_dir($this->directorio)){
            mkdir($this->directorio, 0755);
        }
    }
    
    public function arquivo(array $arquivo, string $subDirectorio = null)
    {
        $this->arquivo = $arquivo;
        
        $this->subDirectorio = $subDirectorio ?? 'arquivos';
        
        $this->criarSubDirectorio();
        $this->moverArquivo();
    }
    
    public function criarSubDirectorio(): void
    {
        if (!file_exists($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio)  && !is_dir($this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio)){
            mkdir($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio, 0755);
        }
    }
    
    public function moverArquivo(): void
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio.DIRECTORY_SEPARATOR.$this->arquivo['name'])){
            echo $this->arquivo['name']. ', foi movido com sucesso';
        } else {
            echo 'Erro ao enviar arquivo';
        }
    }
}
