<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/app.php';
require_once __DIR__ . '/config/configDefinicoes.php';

use Resources\Router;

$response = new Router(APP);

foreach (ROTAS as $value) {
    require_once __DIR__ . '/rotas/' . $value . '.php';
}

foreach (RESOURCES as $value) {
    require_once __DIR__ . '/resources/' . $value . '.php';
}

try {
    $response->run()->sendResponse();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
