<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelFilmes
{
    public static function listarFilmes($where = null, $order = null, $limit = null, $field = '*')
    {
        return (new Database('tb_filmes'))->selecionar($where, $order, $limit, $field);
    }

    public static function obterFilmePorId(int $id)
    {
        return self::listarFilmes('id = ' . $id)->fetchObject(self::class);
    }
}
