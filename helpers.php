<?php

function validarUrlComFiltro(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function validarUrl(string $url): bool{
    if(mb_strlen($url) < 10){
        return false;
    }
    if(!str_contains($url, '.')){
        return false;
    }
    if(str_contains($url, 'http://') or str_contains($url, 'https://')){
        return true;
    }
    return false;
}

function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function formatarValor(float $valor): string
{
    return number_format($valor ?: 2, ",", ".");
}

function formatarNumero(string $numero = null): string
{
    return number_format($numero ?: 0,0,'.', '.');
}

function saudacao(): string
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
    return $saudacao;
}

function resumirTexto(string $texto, int $limite, string $continue = '...'): string
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

function contarTempo(string $data): string
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
    
    if($segundos <= 60){
        return 'agora';
        
    } elseif ($minutos <60) {
        return $minutos == 1 ? 'há 1 minuto' : 'há '.$minutos.' minutos';
        
    }elseif ($horas <= 24) {
        return $horas == 1 ? 'há 1 hora' : 'há '.$horas. ' horas';
        
    }elseif ($dias <= 7) {
        return $dias == 1 ? 'ontem' : 'há '.$dias. ' dias';
        
    }elseif ($semanas <= 4) {
        return $semanas == 1 ? 'há 1 semana' : 'há '. $semanas.' semanas';
    
    } elseif ($meses <= 12) {
        return $meses == 1 ? 'há 1 mês' : 'há '. $meses.' meses';
    
    }else {
        return $ano == 1 ? 'há 1 ano' : 'há '. $ano.' anos';
    }
    
}