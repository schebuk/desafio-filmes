<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Resources\{
    Paginacao,
    View,
};
use Src\Model\ModelFavorito;

final class Favorito extends Pagina
{
    private static function obterItemFilmeFavorito($request, &$obPaginacao): string
    {
        $itens = '';
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
            fi.genero AS generoFilme,
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
                'genero' => $favoritos->generoFilme,
                'descricao' => $favoritos->descricaoFilme,
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
            'itens' => self::obterItemFilmeFavorito($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
            'status' => self::obterStatus($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/favoritos/index', $dados);
        return parent::obterPainel('Filmes Favoritos - Usuário - Desafio JSL', $conteudo, 'favoritos');
    }
}
