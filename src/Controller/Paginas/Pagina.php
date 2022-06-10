<?php

declare(strict_types=1);

namespace Src\Controller\Paginas;

use Resources\View;

class Pagina
{
    private static function obterCabecalho(): string
    {
        return View::renderizar('paginas/cabecalho');
    }

    private static function obterRodape(): string
    {
        return View::renderizar('paginas/rodape');
    }

    public static function obterPaginacao(object $request, object $obPaginacao): string
    {
        $pages = $obPaginacao->obterPaginas();
        if (count($pages) <= 1) return '';
        $links = '';
        $url = $request->obterRotar()->obterUrlAtual();
        $queryParams = $request->getQueryParams();

        foreach ($pages as $page) {
            $queryParams['pagina'] = $page['pagina'];
            $link = $url . '?' . http_build_query($queryParams);
            $links .= View::renderizar('paginas/paginacao/link', [
                'pagina' => $page['pagina'],
                'link' => $link,
                'ativo' => $page['ativo'] ? 'active' : '',
            ]);
        }

        return View::renderizar('paginas/paginacao/box', [
            'links' => $links,
        ]);
    }

    public static function obterPagina(string $titulo, string $conteudo): string
    {
        $dados = [
            'titulo' => $titulo,
            'cabecalho' => self::obterCabecalho(),
            'conteudo' => $conteudo,
            'rodape' => self::obterRodape(),
        ];
        return View::renderizar('paginas/pagina', $dados);
    }
}
