<?php

namespace sistema\biblioteca;

/**
 * Retorna o resultado
 *@return string|null = Nome do arquivo
 * @author Administrador
 */
class Upload
{   
    private ?string $directorio;
    private ?array $arquivo;
    private ?string $nome;
    private ?string $subDirectorio;
    private ?int $tamanho;
    private ?string $resultado;
    private ?string $erro;
    
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
    
    public function arquivo(array $arquivo, string $nome = null, string $subDirectorio = null, int $tamanho = null)
    {
        $this->arquivo = $arquivo;
        
        $this->nome = $nome  ?? pathinfo($this->arquivo['name'], PATHINFO_FILENAME);
        
        $this->subDirectorio = $subDirectorio ?? 'arquivos';
        
        $extensao = pathinfo($this->arquivo['name'], PATHINFO_EXTENSION);
        
        $this->tamanho = $tamanho ?? 1;
        
        $extensoesValidas = [
            'pdf',
            'png',
            'docx'
        ];
        
        $tiposValidos = [
            'application/pdf',
            'text/plain',
            'image/png'
        ];
        
        if (!in_array($extensao, $extensoesValidas)){
            $this->erro = 'extensão não permitida. voçê só pode enviar .'.implode(' .', $extensoesValidas);
        }elseif (!in_array($this->arquivo['type'], $tiposValidos)) {
            $this->erro = 'Tipo não permitido';
        }elseif ($this->arquivo['size'] > $this->tamanho * (1024 * 1024)) {
            $this->erro = "arquivo muito grande, permitido {$this->tamanho}MB seu arquivo tem {$this->arquivo['size']}";
        }else {
            $this->criarSubDirectorio();
            $this->renomearArquivo();
            $this->moverArquivo();
        }
     }
    
     private function criarSubDirectorio(): void
    {
        if (!file_exists($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio)  && !is_dir($this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio)){
            mkdir($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio, 0755);
        }
    }
    
    private function renomearArquivo(): void
    {
        echo $arquivo = $this->nome.strrchr($this->arquivo['name'], '.');
        if (file_exists($this->directorio.DIRECTORY_SEPARATOR.$this->subDirectorio. DIRECTORY_SEPARATOR.$arquivo)){
            $arquivo = $this->nome.'-'. uniqid().strrchr($this->arquivo['name'], '.');
        }
        $this->nome = $arquivo;
    }
    
    private function moverArquivo(): void
    {
        if (move_uploaded_file($this->arquivo['tmp_name'], $this->directorio. DIRECTORY_SEPARATOR.$this->subDirectorio.DIRECTORY_SEPARATOR.$this->nome)){
            $this->resultado = $this->nome;
        } else {
            $this->resultado = null;
            $this->erro = 'Erro ao enviar arquivo';
        }
    }
}
