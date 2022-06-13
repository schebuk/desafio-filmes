<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\{
    Funcoes,
    Paginacao,
    View,
};
use Src\Model\ModelFavorito;

final class Favorito extends Pagina
{
    private static function obterItemFilmeFavorito($request, &$obPaginacao): string
    {
        $itens = '';
        $funcoes = new Funcoes();

        $qtdeTotal = ModelFavorito::listarFilmesFavoritos(
            'fa.status = "A" AND fa.apagado_em IS NULL AND fa.usuario_id = "' . $_SESSION['usuario']['id'] . '"',
            'fa.criado_em DESC',
            null,
            'COUNT(*) AS qtde',
            'tb_filmes AS fi',
            'fa.filme_id = fi.id'
        )->fetchObject()->qtde;

        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 12);
        $retorno = ModelFavorito::listarFilmesFavoritos(
            'fa.status = "A" AND fa.apagado_em IS NULL AND fa.usuario_id = "' . $_SESSION['usuario']['id'] . '"',
            'fa.criado_em DESC',
            $obPaginacao->obterLimite(),
            'fa.*, fi.id AS idFilme,
            fi.titulo AS tituloFilme,
            fi.imagem AS imagemFilme,
            fi.descricao AS descricaoFilme,
            fi.classificacao AS classificacaoFilme,
            fi.criado_em AS criadoEm',
            'tb_filmes AS fi',
            'fa.filme_id = fi.id'
        );

        while ($favoritos = $retorno->fetchObject(ModelFavorito::class)) {
            $dados = [
                'id' => $favoritos->idFilme,
                'titulo' => $favoritos->tituloFilme,
                'imagem' => $favoritos->imagemFilme,
                'descricao' => $funcoes->limitarCaracteres($favoritos->descricaoFilme, 49, false),
                'classificacao' => $favoritos->classificacaoFilme,
                'data' => date('d/m/Y', strtotime($favoritos->criadoEm)),
            ];
            $itens .= View::renderizar('usuarios/modulos/favoritos/item', $dados);
        }
        return $itens;
    }

    private static function obterStatus(object $request): string
    {
        $queryParams = $request->getQueryParams();
        if (!isset($queryParams['status']))  return '';

        switch ($queryParams['status']) {
            case 'criado':
                return Alerta::obterAlerta('success', 'Depoimento <strong>criado</strong> com sucesso!');
                break;
            case 'alterado':
                return Alerta::obterAlerta('success', 'Depoimento <strong>alterado</strong> com sucesso!');
                break;
            case 'apagado':
                return Alerta::obterAlerta('success', 'Depoimento <strong>apagado</strong> com sucesso!');
                break;
        }
    }

    public static function obterFilmesFavoritos($request)
    {
        $dados = [
            'header' => 'Filmes Favoritos',
            'itens' => !empty(self::obterItemFilmeFavorito($request, $obPaginacao)) ?
                self::obterItemFilmeFavorito($request, $obPaginacao) :
                Alerta::obterAlerta('danger', 'Não há filmes marcados como favoritos!'),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
            'status' => self::obterStatus($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/favoritos/index', $dados);
        return parent::obterPainel('Filmes Favoritos - Usuário - Desafio JSL', $conteudo, 'favoritos');
    }

    public static function removerFavorito(object $request, int $id): string
    {
        $objFavorito = ModelFavorito::obterFilmeFavoritoPorId($id);
        if (empty($objFavorito)) {
            if (!$objFavorito instanceof ModelFavorito) {
                $request->obterRota()->redirecionar('/usuario/favoritos');
            }
        }

        $dados = [
            'header' => 'Apagar Filme Favorito',
        ];
        $content = View::renderizar('usuarios/modulos/favoritos/apagar', $dados);
        return parent::obterPainel('Apagar Filme Favorito - Usuário - Desafio JSL', $content, 'favoritos');
    }

    public static function definirRemoverFavorito(object $request, int $id): mixed
    {
        $objFavorito = ModelFavorito::obterFilmeFavoritoPorId($id);
        if (!$objFavorito instanceof ModelFavorito) {
            $request->obterRota()->redirecionar('/usuario/favoritos');
        }

        $objFavorito->excluir();
        $request->obterRota()->redirecionar('/usuario/favoritos?status=apagado');
    }
}
