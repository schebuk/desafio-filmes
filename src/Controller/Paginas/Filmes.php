<?php

declare(strict_types=1);

namespace Src\Controller\Paginas;

use Resources\Paginacao;
use Resources\View;
use Src\Model\ModelFilmes;

class Filmes extends Pagina
{
    private static function obterCatalogoFilmes($request, &$obPaginacao): string
    {
        $itens = '';
        $qtdeTotal = ModelFilmes::listarFilmes(
            'status = "A" AND apagado_em IS NULL',
            null,
            null,
            'COUNT(*) AS qtde'
        )->fetchObject()->qtde;
        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 5);
        $retorno = ModelFilmes::listarFilmes(
            'status = "A" AND apagado_em IS NULL',
            'id DESC',
            $obPaginacao->obterLimite()
        );

        while ($filmes = $retorno->fetchObject(ModelFilmes::class)) {
            $dados = [
                'titulo' => $filmes->titulo,
                'genero' => $filmes->genero,
                'descricao' => $filmes->descricao,
                'classificacao' => $filmes->classificacao,
                'data' => date('d/m/Y', strtotime($filmes->criado_em)),
            ];
            $itens .= View::renderizar('paginas/componente/item', $dados);
        }
        return $itens;
    }

    public static function listarFilmes($request): string
    {
        $dados = [
            'titulo' => 'Catálogo de Filmes',
            'itens' => self::obterCatalogoFilmes($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
        ];
        $retorno = View::renderizar('paginas/filmes', $dados);
        return parent::obterPagina('Catálogo de Filmes - Desafio JSL', $retorno);
    }
}
