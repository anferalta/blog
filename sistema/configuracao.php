<?php

//   echo ' Arquivo de configuração do sistema';

//define o fuso horário
date_default_timezone_set('Africa/Luanda');

//define nomes do BANCO DE DADOS
define('DB_HOST', 'localhost');
define('DB_PORTA', '3306');
define('DB_NOME', 'blog');
define('DB_USUARIO', 'root');
define('DB_SENHA', '');

//informações do sistema
define('SITE_NOME', 'UnSet');
define('SITE_DESCRIÇAO', 'UnSet - Tecnologia em Sistemas');

//urls do sistema
define('URL_PRODUÇAO', 'http://unset.com.br');
define('URL_DESENVOLVIMENTO', 'http://localhost/blog');

define('URL_SITE', 'blog/');
define('URL_ADMIN', 'blog/admin/');

