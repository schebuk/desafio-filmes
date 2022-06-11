<?php

declare(strict_types=1);

$https = filter_input(INPUT_SERVER, 'HTTPS');
$protocolo = (isset($https) && ($https == 'on') ? 'https://' : 'http://');

define('HOST', filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL));
define('APP', $protocolo . HOST . '/desafio');

define('ASSETS', APP . '/public_html');
define('CSS', ASSETS . '/css');
define('JS', ASSETS . '/js');
define('IMG', ASSETS . '/img');
define('FONTS', ASSETS . '/fonts/css');
define('REMOTO', ASSETS . 'https://agenciab33.com.br/desafio');

define('MANUTENCAO', false);

define('SITE_KEY', '');
define('SECRET_KEY', '');
define('TMDB_KEY', '04b5443303a7051dc3f419e4424a8399');

define('ROTAS', ['paginas', 'usuarios']);
define('RESOURCES', ['Database', 'Funcoes', 'Paginacao', 'Request', 'Response', 'Router', 'Sessao', 'View',]);
