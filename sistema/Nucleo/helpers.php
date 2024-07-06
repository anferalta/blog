<?php

namespace sistema\Nucleo;

class Helpers
{
    
public static function validarCPF(string $cpf) : bool
{
    $cpf = self::limparNumero($cpf);
    
    if(mb_strlen($cpf) != 11 or preg_match('/(\d)\1{10}/', $cpf)){
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
        return true;
}

public static function limparNumero(string $numero) : string
{
    return preg_replace('/[^0-9]/', '', $numero);
}

public static function slug(string $string): string
{
    $mapa['a'] = 'ÁÀÂÃÇÉÈÊÍÌÎÑÓÒÕÔÚÙÛÝáàãâçéèêíìîñóòôõúùû@$%#&*() -+= {[]}/?´´|;:.,\\<> ';

    $mapa['b'] = 'aaaaceeeiiinoooouuuyaaaaceeeiiinoooouuu';

    $slug = strtr(utf8_decode($string), utf8_decode($mapa['a']), $mapa['b']);

    $slug = strip_tags(trim($slug));
    $slug = str_replace(' ', '-', $slug);
    $slug = str_replace(['-----', '----', '---', '--', '-'], '-', $slug);

    return strtolower(utf8_decode($slug));
}

public static function dataAtual(): string
{
    $diaMes = date('d');
    $diaSemana = date('w');
    $mes = date('n') - 1;
    $ano = date('Y');

    $nomesDiasDaSemana = [
        'Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'
    ];

    $nomesDosMeses = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    ];

    $dataFormatada = $nomesDiasDaSemana[$diaSemana] . ', ' . $diaMes . ' de ' . $nomesDosMeses[$mes] . ' de ' . $ano;

    return $dataFormatada;
}

public static function url(string $url): string
{
    $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
    $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUÇAO);

    if (str_starts_with($url, '/')) {
        return $ambiente . $url;
    }

    return $ambiente . '/' . $url;
}

public static function localhost(): bool
{
    $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

    if ($servidor == 'localhost') {
        return true;
    }
    return false;
}

public static function validarUrlComFiltro(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

public static function validarUrl(string $url): bool
{
    if (mb_strlen($url) < 10) {
        return false;
    }
    if (!str_contains($url, '.')) {
        return false;
    }
    if (str_contains($url, 'http://') or str_contains($url, 'https://')) {
        return true;
    }
    return false;
}

public static function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public static function formatarValor(float $valor): string
{
    return number_format($valor ?: 2, ",", ".");
}

public static function formatarNumero(string $numero = null): string
{
    return number_format($numero ?: 0, 0, '.', '.');
}

public static function saudacao(): string
{
    $hora = date('H');
    if ($hora >= 0 && $hora <= 5) {
        $saudacao = 'boa madrugada';
    } elseif ($hora >= 6 and $hora <= 12) {
        $saudacao = 'bom dia';
    } elseif ($hora >= 13 and $hora <= 18) {
        $saudacao = 'boa tarde';
    } else {
        $saudacao = 'boa noite';
    }

    //$saudacao = match (true){
    //$hora => 0 and $hora <= 5 => 'boa madrugada',
    //$hora => 6 and $hora <= 12 => 'bom dia',
    //$hora => 13 and $hora <= 18 => 'boa tarde',
    //default => 'boa noite' 
    //};    

    return $saudacao;
}

public static function resumirTexto(string $texto, int $limite, string $continue = '...'): string
{
    $textoLimpo = trim($texto);
    if (mb_strlen($textoLimpo) <= $limite) {
        return $textoLimpo;
    }

    $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));

    return $resumirTexto . $continue;
}

/**
 * Conta o tempo decorrido de uma data
 * @param string $data
 * @return string
 */
public static function contarTempo(string $data): string
{
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtotime($data);
    $diferenca = $agora - $tempo;

    $segundos = $diferenca;
    $minutos = round($diferenca / 60);
    $horas = round($diferenca / 3600);
    $dias = round($diferenca / 86400);
    $semanas = round($diferenca / 604800);
    $meses = round($diferenca / 2419200);
    $ano = round($diferenca / 29030400);

    if ($segundos <= 60) {
        return 'agora';
    } elseif ($minutos < 60) {
        return $minutos == 1 ? 'há 1 minuto' : 'há ' . $minutos . ' minutos';
    } elseif ($horas <= 24) {
        return $horas == 1 ? 'há 1 hora' : 'há ' . $horas . ' horas';
    } elseif ($dias <= 7) {
        return $dias == 1 ? 'ontem' : 'há ' . $dias . ' dias';
    } elseif ($semanas <= 4) {
        return $semanas == 1 ? 'há 1 semana' : 'há ' . $semanas . ' semanas';
    } elseif ($meses <= 12) {
        return $meses == 1 ? 'há 1 mês' : 'há ' . $meses . ' meses';
    } else {
        return $ano == 1 ? 'há 1 ano' : 'há ' . $ano . ' anos';
    }
}

}