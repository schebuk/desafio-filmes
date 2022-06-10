<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\{
    Sessao,
    View,
};
use Src\Model\ModelUsuario;

final class Login extends Pagina
{
    public static function obterLogin($request, $errorMessage = null)
    {
        $status = !is_null($errorMessage) ? Alerta::obterAlerta('danger', $errorMessage) : '';
        $dados = ['status' => $status];

        $conteudo = View::renderizar('usuarios/login', $dados);
        return parent::obterPagina('Login - Usuário - Desafio JSL', $conteudo);
    }

    public static function definirLogin($request)
    {
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        $obUser = ModelUsuario::obterUsuarioPorEmail($email);
        if (!$obUser instanceof ModelUsuario) {
            return self::obterLogin($request, 'E-mail inválido!');
        }
        if (!password_verify($senha, $obUser->senha)) {
            return self::obterLogin($request, 'Senha inválida!');
        }
        Sessao::login($obUser);
        $request->obterRotar()->redirecionar('/usuario');
    }

    public static function setLogout($request): mixed
    {
        Sessao::logout();
        $request->obterRotar()->redirecionar('/usuario/login');
    }

    public static function obterCadastrarNovoUsuario($request, $errorMessage = null): string
    {
        $status = !is_null($errorMessage) ? Alerta::obterAlerta('danger', $errorMessage) : '';
        $dados = ['status' => $status];

        $conteudo = View::renderizar('usuarios/cadastro', $dados);
        return parent::obterPagina('Cadastrar Novo Usuário - Usuário - Desafio JSL', $conteudo);
    }

    public static function definirCadastrarNovoUsuario(object $request): mixed
    {
        $postVars = $request->getPostVars();

        $usuario = new ModelUsuario();
        $usuario->nome = $postVars['nome'] ?? '';
        $usuario->email = $postVars['email'] ?? '';
        if ($postVars['senha1'] === $postVars['senha2']) {
            $usuario->senha = password_hash($postVars['senha1'], PASSWORD_BCRYPT) ?? '';
            $usuario->cadastrar();
            $request->obterRotar()->redirecionar('/usuarios/cadastro?status=criado');
        } else {
            $request->obterRotar()->redirecionar('/usuarios/cadastro?status=senha');
        }
    }
}
