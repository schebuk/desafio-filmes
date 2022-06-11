<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use DevUtils\Format;
use Resources\{
    Funcoes,
    Paginacao,
    View,
};
use Src\Model\ModelFavorito;
use Src\Model\ModelFilme;

final class Filme extends Pagina
{
    private static function obterStatus(object $request): string
    {
        $queryParams = $request->getQueryParams();
        if (!isset($queryParams['status']))  return '';

        switch ($queryParams['status']) {
            case 'favoritado':
                return Alerta::obterAlerta('success', 'O filme foi <strong>favoritado</strong> com sucesso!');
                break;
            case 'apagado':
                return Alerta::obterAlerta('success', 'O filme foi <strong>apagado dos favoritos</strong> com sucesso!');
                break;
        }
    }

    private static function obterItemFilme($request, &$obPaginacao): string
    {
        $itens = '';
        $funcoes = new Funcoes();

        $qtdeTotal = ModelFilme::listarFilmes(null, null, null, 'COUNT(*) AS qtde')->fetchObject()->qtde;
        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 8);
        $retorno = ModelFilme::listarFilmes('status = "A"', 'id DESC', $obPaginacao->obterLimite());
        while ($objFilme = $retorno->fetchObject(ModelFilme::class)) {
            $dados = [
                'id' => $objFilme->id,
                'titulo' => $objFilme->titulo,
                'slug' => Format::slugfy($objFilme->titulo),
                'imagem' => $objFilme->imagem,
                'descricao' => $funcoes->limitarCaracteres($objFilme->descricao, 49, false),
                'classificacao' => $objFilme->classificacao,
            ];
            $itens .= View::renderizar('usuarios/modulos/filmes/item', $dados);
        }
        return $itens;
    }

    public static function listarFilmes(object $request): string
    {
        $dados = [
            'header' => 'Catálogo de Filmes',
            'itens' => self::obterItemFilme($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
            'status' => self::obterStatus($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/filmes/index', $dados);
        return parent::obterPainel('Catálogo de Filmes - Usuário - Desafio JSL', $conteudo, 'filmes');
    }

    public static function definirComoFavorito(object $request, int $id): string
    {
        $objFavorito = ModelFilme::obterFilmePorId($id);
        if (!$objFavorito instanceof ModelFilme) {
            $request->obterRotar()->redirecionar('/usuario/filmes');
        }

        $dados = [
            'header' => 'Adicionar como Favorito',
            'titulo' => $objFavorito->titulo,
        ];
        $conteudo = View::renderizar('usuarios/modulos/filmes/definir', $dados);
        return parent::obterPainel('Adicionar como Favorito - Usuário - Desafio JSL', $conteudo, 'filmes');
    }

    public static function definirAceitarComoFavorito(object $request, int $id): mixed
    {
        $objFavoritoPorId = ModelFavorito::obterFilmeFavoritoPorId($id);
        if (!empty($objFavoritoPorId)) {
            if (!$objFavoritoPorId instanceof ModelFavorito) {
                $request->obterRotar()->redirecionar('/usuario/filmes');
            }
        }

        $objFavorito = new ModelFavorito();
        $objFavorito->id = $id ? intval($id) : '';
        $objFavorito->usuarioId = $_SESSION['usuario']['id'];

        $objFavorito->cadastrar();
        $request->obterRotar()->redirecionar('/usuario/filmes?status=favoritado');
    }
}
