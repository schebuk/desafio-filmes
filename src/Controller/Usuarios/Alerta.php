<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\View;

class Alerta
{
    public static function obterAlerta(string $tipo, string $mensagem): string
    {
        $dados = [
            'tipo' => $tipo,
            'mensagem' => $mensagem,
        ];
        return View::renderizar('usuarios/alerta/status', $dados);
    }
}
