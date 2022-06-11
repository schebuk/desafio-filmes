<?php

namespace Mvc\rotas;

use Resources\Response;
use Src\Controller\Paginas;

$response->get('/', [
    function () {
        return new Response(200, Paginas\Home::obterHome());
    }
]);

$response->get('/filmes', [
    function ($request) {
        return new Response(200, Paginas\Filme::listarFilmes($request));
    }
]);
