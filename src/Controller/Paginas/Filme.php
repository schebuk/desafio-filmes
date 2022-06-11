<?php

declare(strict_types=1);

namespace Src\Controller\Paginas;

use Resources\{
    Funcoes,
    View,
};
use Src\Model\ModelFilme;

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

    private static function validarSeFilmeEstaGravadoBd(array $filme): void
    {
        $objFilme = new ModelFilme();
        $objGravadoBd = $objFilme->obterFilmePorTmdbId($filme['id']);
        if (!$objGravadoBd instanceof ModelFilme) {
            $objFilme->tmdbId = $filme['id'];
            $objFilme->titulo = $filme['original_title'];
            $objFilme->imagem = !empty($filme['poster_path']) ?
                'https://image.tmdb.org/t/p/w185' . $filme['poster_path'] : IMG . '/semImagem.png';
            $objFilme->descricao = !empty($filme['overview']) ?
                $filme['overview'] : 'Não há descrição cadastrada na API TMDB!';
            $objFilme->classificacao = $filme['vote_average'];

            $objFilme->cadastrar();
        }
    }

    private static function obterCatalogoFilmes(): string
    {
        $itens = '';

        /** Consome API via cURL */
        $retorno = self::consumirApiCurlTmdb()['results'];
        $funcoes = new Funcoes();

        /** Popula o BD para listar no módulo do usuário */
        if (!empty($retorno)) {
            foreach ($retorno as $filme) {
                /** Valida se o filme já está cadastrado no BD */
                self::validarSeFilmeEstaGravadoBd($filme);
                $dados = [
                    'id' => $filme['id'],
                    'titulo' => $filme['original_title'],
                    'imagem' => !empty($filme['poster_path']) ?
                        'https://image.tmdb.org/t/p/w185' . $filme['poster_path'] :
                        IMG . '/semImagem.png',
                    'descricao' => !empty($filme['overview']) ?
                        $funcoes->limitarCaracteres($filme['overview'], 49, false) :
                        'Nenhuma descrição cadastrada!',
                    'classificacao' => $filme['vote_average'],
                ];
                $itens .= View::renderizar('paginas/componente/item', $dados);
            }
            return $itens;
        }
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
