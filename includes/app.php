<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/configDefinicoes.php';
require __DIR__ . '/../config/configDatabase.php';

use Resources\{
    Database,
    View,
};
use Resources\Middleware\Queue;

Database::config(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_PORT);

View::iniciar([
    'APP' => APP,
    'CSS' => CSS,
    'JS' => JS,
    'IMG' => IMG,
    'FONTS' => FONTS,
    'REMOTO' => REMOTO,
    'MANUTENCAO' => MANUTENCAO,
]);

Queue::definirMapa([
    'manutencao' => \Resources\Middleware\Manutencao::class,
    'exigir-logout' => \Resources\Middleware\ExigirLogoutUsuario::class,
    'exigir-login' => \Resources\Middleware\ExigirLoginUsuario::class,
]);

Queue::definirPadrao([
    'manutencao',
]);
