<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelFavorito
{
    public static function listarFilmesFavoritos(
        $where = null,
        $order = null,
        $limit = null,
        $field = '*',
        $tableJoin = null,
        $join = null
    ) {
        return (new Database('tb_favoritos AS fa'))->join($where, $order, $limit, $field, $tableJoin, $join);
    }

    public static function obterFilmeFavoritoPorId(int $id)
    {
        return self::listarFilmesFavoritos('id = ' . $id)->fetchObject(self::class);
    }
}
