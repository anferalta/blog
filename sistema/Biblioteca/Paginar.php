<?php

namespace sistema\biblioteca;

/**
 * Classe responsável pela paginação de registros.
 *
 * @author Administrador
 */
class Paginar
{
    private int $offset;
    private int $totalRegistros;
    private int $pagina;
    private int $limite;

    /**
     * Construtor da classe.
     */
    public function __construct(int $offset, int $totalRegistros, int $pagina, int $limite)
    {
        $this->offset = $offset;
        $this->totalRegistros = $totalRegistros;
        $this->pagina = $pagina;
        $this->limite = $limite;
    }

    /**
     * Retorna uma string informando o intervalo de registros exibidos.
     */
    public function info(): string
    {
        $totalInicial = $this->offset + 1;
        $totalFinal = min($this->totalRegistros, $this->pagina * $this->limite);
        $totalRegistrosFormatado = number_format($this->totalRegistros, 0, '', '.');

        return "Mostrando {$totalInicial} até {$totalFinal} de {$totalRegistrosFormatado} registros";
    }
}