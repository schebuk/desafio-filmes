<?php

declare(strict_types=1);

namespace Src\Model;

use Resources\Database;

final class ModelUsuario
{
    public $id;
    public $nome;
    public $email;
    public $senha;

    public static function obterUsuarioPorEmail(string $email)
    {
        return (new Database('tb_usuarios'))->selecionar('email = "' . $email . '"')->fetchObject(self::class);
    }

    public static function obterUsuarios($where = null, $order = null, $limit = null, $field = '*')
    {
        return (new Database('tb_usuarios'))->selecionar($where, $order, $limit, $field);
    }

    public function cadastrar(): bool
    {
        $this->data = date('Y-m-d H:m:i');
        $this->id = (new Database('tb_usuarios'))->inserir([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha1,
            'status' => 'A',
            'funcao' => 'USR',
            'criado_em' => $this->data,
        ]);

        return true;
    }

    public static function obterUsuarioPorId(int $id)
    {
        return self::obterUsuarios('id = ' . $id)->fetchObject(self::class);
    }

    public function atualizar(): bool
    {
        $this->data = date('Y-m-d H:m:i');
        if (!empty($this->senha)) {
            return (new Database('tb_usuarios'))->atualizar(
                'id = ' . $this->id,
                [
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'senha' => $this->senha,
                    'alterado_em' => $this->data,
                ]
            );
        } else {
            return (new Database('tb_usuarios'))->atualizar(
                'id = ' . $this->id,
                [
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'alterado_em' => $this->data,
                ]
            );
        }
    }

    public function excluir(): bool
    {
        return (new Database('tb_usuarios'))->excluir('id = ' . $this->id);
    }
}
