<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelFilme
{
    public $id;
    public $tmdbId;
    public $titulo;
    public $imagem;
    public $descricao;
    public $classificacao;
    public $data;

    public static function listarFilmes($where = null, $order = null, $limit = null, $field = '*')
    {
        return (new Database('tb_filmes'))->selecionar($where, $order, $limit, $field);
    }

    public static function obterFilmePorId(int $id)
    {
        return self::listarFilmes('id = ' . $id)->fetchObject(self::class);
    }

    public static function obterFilmePorTmdbId(int $tmdbId)
    {
        return self::listarFilmes('tmdb_id = ' . $tmdbId)->fetchObject(self::class);
    }

    public function cadastrar(): bool
    {
        $this->data = date('Y-m-d H:m:i');
        $this->id = (new Database('tb_filmes'))->inserir([
            'tmdb_id ' => $this->tmdbId,
            'titulo' => $this->titulo,
            'imagem' => $this->imagem,
            'descricao' => $this->descricao,
            'classificacao' => $this->classificacao,
            'status' => 'A',
            'criado_em' => $this->data,
        ]);

        return true;
    }
}
