<?php

namespace sistema\biblioteca;

/**
 * Description of Paginar
 *
 * @author Administrador
 */
class Paginar

public function info(): string
{
    $totalInicial = $this->offset + 1;
    $totalFinal = min($this->totalRegistros, $this->pagina * $this->limite);
    $totalRegistros = number_format($this->totalRegistros, 0, ',', ',');
    
    return "Mostrando {$totalInicial} até {$totalFinal} de {$totalRegistros} registros";
}


