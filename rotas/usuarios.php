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

$response->get('/usuario/filmes/{id}/definir', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Filme::definirComoFavorito($request, $id));
    }
]);

$response->post('/usuario/filmes/{id}/definir', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Filme::definirAceitarComoFavorito($request, $id));
    }
]);

$response->get('/usuario/favoritos/{id}/apagar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Favorito::removerFavorito($request, $id));
    }
]);

$response->post('/usuario/favoritos/{id}/apagar', [
    'middlewares' => [
        'exigir-login',
    ],
    function ($request, $id) {
        return new Response(200, Usuarios\Favorito::definirRemoverFavorito($request, $id));
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

$response->get('/pagina-nao-encontrada', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('404', 'Ooops! Esta página não pode ser encontrada!'));
    }
]);

$response->get('/metodo-nao-permitido', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('405', 'Ooops! O método informado não é permitido!'));
    }
]);

$response->get('/erro-interno-do-servidor', [
    function () {
        return new Response(200, Usuarios\Erro::obterErro('500', 'Algo de errado não esta certo!'));
    }
]);
