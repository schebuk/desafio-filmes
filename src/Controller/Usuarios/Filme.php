<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Src\Model\ModelDepoimento;
use Resources\{
    Funcoes,
    View,
    Paginacao,
};
use Src\Model\ModelFilme;

final class Filme extends Pagina
{
    private static function obterCatalogoDeFilmes($request): string
    {
        $itens = '';
        $apiKey = '04b5443303a7051dc3f419e4424a8399';
        $busca = 'Panico';

        $url = "https://api.themoviedb.org/3/search/movie?query={$busca}&api_key={$apiKey}&language=pt-BR&page=1";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $totalDePaginas = $obj->total_pages;

        $funcoes = new Funcoes();
        for ($x = 1; $x <= $totalDePaginas; $x++) {
            $urlSingle = "https://api.themoviedb.org/3/search/movie?query={$busca}&api_key={$apiKey}&language=pt-BR&page={$x}";
            $jsonSingle = file_get_contents($urlSingle);
            $objSingle = json_decode($jsonSingle);

            foreach ($objSingle->results as $resultado) {
                $dados = [
                    'id' => $resultado->id,
                    'titulo' => $resultado->original_title,
                    'imagem' => !empty($resultado->poster_path) ? 'https://image.tmdb.org/t/p/w185' . $resultado->poster_path : IMG . '/semImagem.png',
                    'descricao' => !empty($resultado->overview) ? $funcoes->limitarCaracteres($resultado->overview, 49, false) : 'Nenhuma descrição cadastrada!',
                    'classificacao' => $resultado->vote_average,
                ];
                $itens .= View::renderizar('usuarios/modulos/filmes/item', $dados);
            }
        }
        return $itens;
    }

    public static function obterCatalogoFilmes(object $request): string
    {
        $dados = [
            'header' => 'Catálogo de Filmes',
            'itens' => self::obterCatalogoDeFilmes($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/filmes/index', $dados);
        return parent::obterPainel('Catálogo de Filmes - Usuário - Desafio JSL', $conteudo, 'filmes');
    }

    public static function obterDetalhesDoFilme(int $id): string
    {
        $dados = [
            'header' => 'Catálogo de Filmes',
            //'itens' => self::obterCatalogoDeFilmes($request, $id),
        ];
        $conteudo = View::renderizar('usuarios/modulos/filmes/index', $dados);
        return parent::obterPainel('Catálogo de Filmes - Usuário - Desafio JSL', $conteudo, 'filmes');
    }
}
