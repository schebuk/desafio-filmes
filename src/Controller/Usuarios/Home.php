<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\Sessao;
use Resources\View;

final class Home extends Pagina
{
    public static function obterHome($request)
    {
        $dados = [];
        $content = View::renderizar('usuarios/modulos/home/index', $dados);
        return parent::obterPainel('Home - Usuário - Desafio JSL', $content, 'home');
    }
}
