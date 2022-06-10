<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\{
    Paginacao,
    View,
};
use Src\Model\ModelUsuario;

final class Usuario extends Pagina
{
    private static function obterItemUsuario($request, &$obPaginacao): string
    {
        $itens = '';
        $qtdeTotal = ModelUsuario::obterUsuarios('status = "A"', null, null, 'COUNT(*) AS qtde')->fetchObject()->qtde;

        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 2);
        $retorno = ModelUsuario::obterUsuarios('status = "A"', 'id DESC', $obPaginacao->obterLimite());
        while ($obUser = $retorno->fetchObject(ModelUsuario::class)) {
            $dados = [
                'id' => $obUser->id,
                'nome' => $obUser->nome,
                'email' => $obUser->email,
                'data' => date('d/m/Y', strtotime($obUser->criado_em)),
            ];
            $itens .= View::renderizar('usuarios/modulos/usuarios/item', $dados);
        }
        return $itens;
    }

    private static function obterStatus(object $request): string
    {
        $queryParams = $request->getQueryParams();
        if (!isset($queryParams['status']))  return '';

        switch ($queryParams['status']) {
            case 'criado':
                return Alerta::obterAlerta('success', 'Usuário <strong>criado</strong> com sucesso!');
                break;
            case 'alterado':
                return Alerta::obterAlerta('success', 'Usuário <strong>alterado</strong> com sucesso!');
                break;
            case 'apagado':
                return Alerta::obterAlerta('success', 'Usuário <strong>apagado</strong> com sucesso!');
                break;
        }
    }

    public static function obterUsuarios(object $request): string
    {
        $dados = [
            'header' => 'Usuários',
            'itens' => self::obterItemUsuario($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
            'status' => self::obterStatus($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/usuarios/index', $dados);
        return parent::obterPainel('Usuários - Usuário - Desafio JSL', $conteudo, 'usuarios');
    }

    public static function obterNovoUsuario(): string
    {
        $dados = [
            'header' => 'Cadastrar Usuário',
            'nome' => '',
            'email' => '',
            'senha' => '',
            'required' => 'required',
            'status' => '',
        ];
        $conteudo = View::renderizar('usuarios/modulos/usuarios/form', $dados);
        return parent::obterPainel('Cadastrar Usuário - Usuário - Desafio JSL', $conteudo, 'usuarios');
    }

    public static function definirNovoUsuario(object $request): mixed
    {
        $postVars = $request->getPostVars();

        $obUser = new ModelUsuario();
        $obUser->nome = $postVars['nome'] ?? '';
        $obUser->email = $postVars['email'] ?? '';
        $obUser->senha = password_hash($postVars['senha'], PASSWORD_BCRYPT) ?? '';
        $obUser->cadastrar();

        $request->obterRotar()->redirecionar('/usuario/usuarios/' . $obUser->id . '/editar?status=criado');
    }

    public static function obterEditarUsuario(object $request, int $id): string
    {
        $obUser = ModelUsuario::obterUsuarioPorId($id);
        if (!$obUser instanceof ModelUsuario) {
            $request->obterRotar()->redirecionar('/usuario/usuarios');
        }

        $dados = [
            'header' => 'Editar Usuário',
            'nome' => $obUser->name,
            'email' => $obUser->email,
            'senha' => '',
            'required' => '',
            'status' => self::obterStatus($request),
        ];
        $content = View::renderizar('usuarios/modulos/usuarios/form', $dados);
        return parent::obterPainel('Editar usuário - Usuário - Desafio JSL', $content, 'usuarios');
    }

    public static function definirEditarUsuario(object $request, int $id): mixed
    {
        $obUser = ModelUsuario::obterUsuarioPorId($id);
        if (!$obUser instanceof ModelUsuario) {
            $request->obterRotar()->redirecionar('/usuario/usuarios');
        }

        $postVars = $request->getPostVars();
        $obUser->nome = $postVars['nome'] ?? $obUser->name;
        $obUser->email = $postVars['email'] ?? $obUser->email;
        $obUser->senha = $postVars['senha'] ? password_hash($postVars['senha'], PASSWORD_BCRYPT) : null;
        $obUser->atualizar();

        $request->obterRotar()->redirecionar('/usuario/usuarios/' . $obUser->id . '/editar?status=alterado');
    }

    public static function obterApagarUsuario(object $request, int $id): string
    {
        $obUser = ModelUsuario::obterUsuarioPorId($id);
        if (!$obUser instanceof ModelUsuario) {
            $request->obterRotar()->redirecionar('/usuario/usuarios');
        }

        $dados = [
            'header' => 'Apagar Usuário',
            'nome' => $obUser->name,
            'email' => $obUser->email,
            'senha' => $obUser->password,
        ];
        $content = View::renderizar('usuarios/modulos/usuarios/delete', $dados);
        return parent::obterPainel('Apagar Usuário - Usuário - Desafio JSL', $content, 'usuarios');
    }

    public static function definirApagarUsuario(object $request, int $id): mixed
    {
        $obUser = ModelUsuario::obterUsuarioPorId($id);
        if (!$obUser instanceof ModelUsuario) {
            $request->obterRotar()->redirecionar('/usuario/usuarios');
        }

        $obUser->excluir();
        $request->obterRotar()->redirecionar('/usuario/usuarios?status=apagado');
    }
}
