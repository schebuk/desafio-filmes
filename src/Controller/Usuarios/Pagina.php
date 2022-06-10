<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\View;

class Pagina
{
    private static $modulos = [
        'home' => [
            'label' => 'Home',
            'link' => APP . '/usuario',
        ],
        'filmes' => [
            'label' => 'Catálogo de Filmes',
            'link' => APP . '/usuario/filmes',
        ],
        'favoritos' => [
            'label' => 'Meus Favoritos',
            'link' => APP . '/usuario/favoritos',
        ],
        'usuarios' => [
            'label' => 'Usuários',
            'link' => APP . '/usuario/usuarios',
        ],
    ];

    private static function obterMenu(string $moduloAtual): string
    {
        $links = '';
        foreach (self::$modulos as $hash => $modulo) {
            $links .= View::renderizar('usuarios/menu/link', [
                'label' => $modulo['label'],
                'link' => $modulo['link'],
                'ativo' => $hash === $moduloAtual ? 'active' : '',
            ]);
        }
        $dados = ['links' => $links];
        return View::renderizar('usuarios/menu/box', $dados);
    }

    private static function obterRodape(): string
    {
        return View::renderizar('usuarios/rodape');
    }

    public static function obterPagina(string $titulo, string $conteudo): string
    {
        $dados = [
            'titulo' => $titulo,
            'conteudo' => $conteudo,
            'rodape' => self::obterRodape(),
        ];
        return View::renderizar('usuarios/pagina', $dados);
    }

    public static function obterPainel(string $titulo, string $conteudo, string $moduloAtual): string
    {
        $dados = [
            'menu' => self::obterMenu($moduloAtual),
            'conteudo' => $conteudo,
        ];
        $conteudoPainel = View::renderizar('usuarios/painel', $dados);
        return self::obterPagina($titulo, $conteudoPainel);
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
            $links .= View::renderizar('usuarios/paginacao/link', [
                'pagina' => $page['pagina'],
                'link' => $link,
                'ativo' => $page['ativo'] ? 'active' : '',
            ]);
        }

        return View::renderizar('usuarios/paginacao/box', ['links' => $links]);
    }
}
