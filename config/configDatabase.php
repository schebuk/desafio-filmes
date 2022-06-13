<?php

declare(strict_types=1);

$server = filter_input(INPUT_SERVER, 'SERVER_NAME');

define('DB_TYPE', 'mysql');
define('DB_PORT', 3306);

if ($server === 'agenciab33.com.br' || $server === 'www.agenciab33.com.br') {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'agen3762_admin');
    define('DB_PASS', '91I0pGyk4SUkEZcBYR');
    define('DB_NAME', 'agen3762_desafio');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'db_desafio');
}
