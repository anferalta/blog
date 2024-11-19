<?php

use sistema\Nucleo\Helpers;

//   echo ' Arquivo de configuração do sistema';

//define o fuso horário
date_default_timezone_set('Africa/Luanda');

//informações do sistema
define('SITE_NOME', 'Anferalta');
define('SITE_DESCRIÇAO', 'ANFERALTA - Tecnologia em Sistemas');

//urls do sistema
define('URL_PRODUÇAO', 'https://anferalta.com');
define('URL_DESENVOLVIMENTO', 'http://localhost/blog');


    if (Helpers::localhost()) {
        //define nomes do BANCO DE DADOS
        define('DB_HOST', 'localhost');
        define('DB_PORTA', '3306');
        define('DB_NOME', 'blog');
        define('DB_USUARIO', 'root');
        define('DB_SENHA', '');
        
        define('URL_SITE', 'blog/');
        define('URL_ADMIN', 'blog/admin/');

    } else {
        //define nomes do BANCO DE DADOS
        define('DB_HOST', 'localhost');
        define('DB_PORTA', '3306');
        define('DB_NOME', 'anferalta');
        define('DB_USUARIO', 'anferalta');
        define('DB_SENHA', 'T0n!a1me');
        
        define('URL_SITE', 'projecto_html/');
        define('URL_ADMIN', 'projecto_html/admin/');
    }

