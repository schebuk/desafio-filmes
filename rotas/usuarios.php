<?php

namespace Mvc\rotas;

use Resources\Response;
use Src\Controller\Usuarios;

/** Login */

$response->get('/usuario/login', [
    'middlewares' => [
        'exigir-logout',
    ],
    function ($request) {
        return new Response(200, Usuarios\Login::obterLogin($request));
    }
]);

$response->post('/usuario/login', [
    'middlewares' => [
        'exigir-logout',
    ],
    function ($request) {
        return new Response(200, Usuarios\Login::definirLogin($request));
    }
]);

$response->get('/usuario/logout', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Login::setLogout($request));
    }
]);

/** Registrar Novo Usuário */

$response->get('/usuario/cadastro', [
    'middlewares' => [
        'exigir-logout',
    ],
    function ($request) {
        return new Response(200, Usuarios\Login::obterCadastrarNovoUsuario($request));
    }
]);

$response->post('/usuario/cadastro', [
    'middlewares' => [
        'exigir-logout',
    ],
    function ($request) {
        return new Response(200, Usuarios\Login::definirCadastrarNovoUsuario($request));
    }
]);

/** Home */

$response->get('/usuario', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Home::obterHome($request));
    }
]);

/** Filmes */

$response->get('/usuario/filmes', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Filme::listarFilmes($request));
    }
]);

/** Favoritos */

$response->get('/usuario/favoritos', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Favorito::obterFilmesFavoritos($request));
    }
]);

/** Usuários */

$response->get('/usuario/usuarios', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Usuario::obterUsuarios($request));
    }
]);

$response->get('/usuario/usuarios/novo', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Usuario::obterNovoUsuario($request));
    }
]);

$response->post('/usuario/usuarios/novo', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request) {
        return new Response(200, Usuarios\Usuario::definirNovoUsuario($request));
    }
]);

$response->get('/usuario/usuarios/{id}/editar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Usuario::obterEditarUsuario($request, $id));
    }
]);

$response->post('/usuario/usuarios/{id}/editar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Usuario::definirEditarUsuario($request, $id));
    }
]);

$response->get('/usuario/usuarios/{id}/apagar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Usuario::obterApagarUsuario($request, $id));
    }
]);

$response->post('/usuario/usuarios/{id}/apagar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Usuario::definirApagarUsuario($request, $id));
    }
]);

/** Rotas da página de Erros */

$response->get('/page-not-found', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('404', 'Ooops! That page can not be found!'));
    }
]);

$response->get('/method-not-allowed', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('405', 'Ooops! The method informed is not allowed!'));
    }
]);

$response->get('/internal-server-error', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('500', 'There was some error on the server!'));
    }
]);
