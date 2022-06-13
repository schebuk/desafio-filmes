<?php

declare(strict_types=1);

namespace Src\Controller\Paginas;

use Resources\View;

class Home extends Pagina
{
    public static function obterHome(): string
    {
        $retorno = View::renderizar('paginas/home', []);
        return parent::obterPagina('Home - Desafio JSL', $retorno);
    }
}
