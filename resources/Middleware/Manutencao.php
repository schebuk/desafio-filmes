<?php

namespace Resources\Middleware;

use Exception;

final class Manutencao
{
    public function handle($request, $next): object
    {
        if (MANUTENCAO === true) {
            throw new Exception('Página em manutenção!', 200);
        }
        return $next($request);
    }
}
