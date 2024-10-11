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
    public $resultado;
    public $erro;
    
    public function getResultado(): ?string
    {
        return $this->resultado;
    }
    
    public function getErro(): ?string
    {
        return $this->erro;
    }

    public function __construct(string $directorio = null)
    {
        $this->directorio = $directorio ?? 'uploads';
        
        if (!file_exists($this->directorio) && !is_dir($this->directorio)){
            mkdir($this->directorio, 0755);
        }
    }
    
    public function arquivo(array $arquivo, string $nome = null, string $subDirectorio = null)
    {
        $this->arquivo = $arquivo;
        
        $this->nome = $nome  ?? pathinfo($this->arquivo['name'], PATHINFO_FILENAME);
        
        $this->subDirectorio = $subDirectorio ?? 'arquivos';
        
        $this->criarSubDirectorio();
        $this->renomearArquivo();
        $this->moverArquivo();
    }
    
    public function criarSubDirectorio(): void
    {
        if (!file_exists($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio)  && !is_dir($this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio)){
            mkdir($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio, 0755);
        }
    }
    
    public function renomearArquivo(): void
    {
        echo $arquivo = $this->nome.strrchr($this->arquivo['name'], '.');
        if (file_exists($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio. DIRECTORY_SEPARATOR.$arquivo)){
            $arquivo = $this->nome.'-'. uniqid().strrchr($this->arquivo['name'], '.');
        }
        $this->nome = $arquivo;
    }
    
    public function moverArquivo(): void
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio.DIRECTORY_SEPARATOR.$this->nome)){
            $this->resultado = $this->nome;
        } else {
            $this->resultado = null;
            $this->erro = 'Erro ao enviar arquivo';
        }
    }
}
