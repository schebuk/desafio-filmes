<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\{
    Funcoes,
    Paginacao,
    View,
};
use Src\Model\ModelFilme;

final class Filme extends Pagina
{
    private static function obterItemFilme($request, &$obPaginacao): string
    {
        $itens = '';
        $funcoes = new Funcoes();

        $qtdeTotal = ModelFilme::listarFilmes(null, null, null, 'COUNT(*) AS qtde')->fetchObject()->qtde;
        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 8);
        $retorno = ModelFilme::listarFilmes('status = "A"', 'id DESC', $obPaginacao->obterLimite());
        while ($objFilme = $retorno->fetchObject(ModelFilme::class)) {
            $dados = [
                'id' => $objFilme->id,
                'titulo' => $objFilme->titulo,
                'imagem' => $objFilme->imagem,
                'descricao' => $funcoes->limitarCaracteres($objFilme->descricao, 49, false),
                'classificacao' => $objFilme->classificacao,
            ];
            $itens .= View::renderizar('usuarios/modulos/filmes/item', $dados);
        }
        return $itens;
    }

    // private static function consumirApiCurlTmdb(): array
    // {
    //     $busca = 'Panico';
    //     $url = 'https://api.themoviedb.org/3/search/movie?query=' . $busca . '&api_key=' . TMDB_KEY . '&language=pt-BR&page=1';
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    //     $retorno = json_decode(curl_exec($ch), true);
    //     return $retorno;
    // }

    // private static function obterCatalogoFilmes(): string
    // {
    //     $itens = '';
    //     $retorno = self::consumirApiCurlTmdb()['results'];
    //     $funcoes = new Funcoes();
    //     foreach ($retorno as $filme) {
    //         $dados = [
    //             'id' => $filme['id'],
    //             'titulo' => $filme['original_title'],
    //             'imagem' => !empty($filme['poster_path']) ? 'https://image.tmdb.org/t/p/w185' . $filme['poster_path'] : IMG . '/semImagem.png',
    //             'descricao' => !empty($filme['overview']) ? $funcoes->limitarCaracteres($filme['overview'], 49, false) : 'Nenhuma descrição cadastrada!',
    //             'classificacao' => $filme['vote_average'],
    //         ];
    //         $itens .= View::renderizar('usuarios/modulos/filmes/item', $dados);
    //     }
    //     return $itens;
    // }

    public static function listarFilmes(object $request): string
    {
        $dados = [
            'header' => 'Catálogo de Filmes',
            'itens' => self::obterItemFilme($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
        ];
        $conteudo = View::renderizar('usuarios/modulos/filmes/index', $dados);
        return parent::obterPainel('Catálogo de Filmes - Usuário - Desafio JSL', $conteudo, 'filmes');
    }
}
