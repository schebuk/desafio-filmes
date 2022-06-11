<?php

declare(strict_types=1);

namespace Src\Controller\Paginas;

use Resources\{
    Funcoes,
    View,
};

class Filme extends Pagina
{
    private static function consumirApiCurlTmdb(): array
    {
        $busca = 'Panico';
        $url = 'https://api.themoviedb.org/3/search/movie?query=' . $busca . '&api_key=' . TMDB_KEY . '&language=pt-BR&page=1';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $retorno = json_decode(curl_exec($ch), true);
        return $retorno;
    }

    private static function obterCatalogoFilmes(): string
    {
        $itens = '';
        $retorno = self::consumirApiCurlTmdb()['results'];
        $funcoes = new Funcoes();
        foreach ($retorno as $filme) {
            $dados = [
                'id' => $filme['id'],
                'titulo' => $filme['original_title'],
                'imagem' => !empty($filme['poster_path']) ? 'https://image.tmdb.org/t/p/w185' . $filme['poster_path'] : IMG . '/semImagem.png',
                'descricao' => !empty($filme['overview']) ? $funcoes->limitarCaracteres($filme['overview'], 49, false) : 'Nenhuma descrição cadastrada!',
                'classificacao' => $filme['vote_average'],
            ];
            $itens .= View::renderizar('paginas/componente/item', $dados);
        }
        return $itens;
    }

    public static function listarFilmes(): string
    {
        $dados = [
            'titulo' => 'Catálogo de Filmes',
            'itens' => self::obterCatalogoFilmes(),
        ];
        $retorno = View::renderizar('paginas/filmes', $dados);
        return parent::obterPagina('Catálogo de Filmes - Desafio JSL', $retorno);
    }
}
