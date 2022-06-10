<?php

namespace Resources\Middleware;

use Resources\Sessao;

final class ExigirLoginUsuario
{
    public function handle($request, $next): object
    {
        if (!Sessao::estaLogado()) {
            $request->obterRotar()->redirecionar('/usuario/login');
        }
        return $next($request);
    }
}
