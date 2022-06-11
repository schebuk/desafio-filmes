<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelFilme
{
    public static function listarFilmes($where = null, $order = null, $limit = null, $field = '*')
    {
        return (new Database('tb_filmes'))->selecionar($where, $order, $limit, $field);
    }

    public static function obterFilmePorId(int $id)
    {
        return self::listarFilmes('id = ' . $id)->fetchObject(self::class);
    }

    public static function consumirApiTmdb(): void
    {
        $apiKey = '04b5443303a7051dc3f419e4424a8399';
        $busca = '007';

        $url = "http://api.themoviedb.org/3/search/movie?query={$busca}&api_key={$apiKey}&language=pt-BR";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $totalDePaginas = $obj->total_pages;

        for ($x = 1; $x <= $totalDePaginas; $x++) {
            $urlSingle = "http://api.themoviedb.org/3/search/movie?query={$busca}&api_key={$apiKey}&language=pt-BR&page={$x}";
            $jsonSingle = file_get_contents($urlSingle);
            $objSingle = json_decode($jsonSingle);

            foreach ($objSingle->results as $resultado) {
                echo $resultado->title;
            }
        }
    }
}
