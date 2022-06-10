<?php

namespace Resources\Middleware;

use Resources\Sessao;

final class ExigirLogoutUsuario
{
    public function handle($request, $next): object
    {
        if (Sessao::estaLogado()) {
            $request->obterRotar()->redirecionar('/usuario');
        }
        return $next($request);
    }
}
