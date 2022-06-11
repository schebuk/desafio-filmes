<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelFavorito
{
    public $id;
    public $usuarioId;
    public $filmeId;
    public $data;

    public static function listarFilmesfavoritosSemJoin($where = null, $order = null, $limit = null, $field = '*')
    {
        return (new Database('tb_favoritos'))->selecionar($where, $order, $limit, $field);
    }

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
        return self::listarFilmesfavoritosSemJoin('status = "A" AND filme_id = ' . $id)->fetchObject(self::class);
    }

    public function cadastrar(): bool
    {
        $this->data = date('Y-m-d H:m:i');
        $this->id = (new Database('tb_favoritos'))->inserir([
            'usuario_id ' => $this->usuarioId,
            'filme_id' => $this->id,
            'status' => 'A',
            'criado_em' => $this->data,
        ]);

        return true;
    }

    public function excluir(): bool
    {
        return (new Database('tb_favoritos'))->excluir('id = ' . $this->id);
    }
}
