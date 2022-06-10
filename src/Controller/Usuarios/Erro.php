<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\View;

final class Erro extends Pagina
{
    public static function obterErro(string $erro, string $mensagem): string
    {
        $dados = [
            'erro' => $erro,
            'mensagem' => $mensagem,
        ];
        $retorno = View::renderizar('usuarios/erro', $dados);
        return parent::obterPagina('Erro: ' . $erro . ' - ' . $mensagem, $retorno);
    }
}
