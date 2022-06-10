<?php

declare(strict_types=1);

namespace Src\Controller\Usuarios;

use Src\Model\ModelDepoimento;
use Resources\{
    View,
    Paginacao,
};

final class Depoimento extends Pagina
{
    private static function obterItemDepoimento($request, &$obPaginacao): string
    {
        $itens = '';
        $qtdeTotal = ModelDepoimento::obterDepoimentos(null, null, null, 'COUNT(*) AS qtde')->fetchObject()->qtde;

        $queryParams = $request->getQueryParams();
        $pagAtual = $queryParams['pagina'] ?? 1;

        $obPaginacao = new Paginacao($qtdeTotal, $pagAtual, 2);
        $retorno = ModelDepoimento::obterDepoimentos(null, 'id DESC', $obPaginacao->obterLimite());
        while ($obTestimony = $retorno->fetchObject(ModelDepoimento::class)) {
            $dados = [
                'id' => $obTestimony->id,
                'titulo' => $obTestimony->title,
                'texto' => $obTestimony->text,
                'data' => date('d/m/Y', strtotime($obTestimony->criado_em)),
            ];
            $itens .= View::renderizar('usuarios/modulos/depoimentos/item', $dados);
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

    public static function obterDepoimentos(object $request): string
    {
        $dados = [
            'itens' => self::obterItemDepoimento($request, $obPaginacao),
            'paginacao' => parent::obterPaginacao($request, $obPaginacao),
            'status' => self::obterStatus($request),
        ];
        $conteudo = View::renderizar('usuarios/modulos/depoimentos/index', $dados);
        return parent::obterPainel('Depoimentos - Usuário - Desafio JSL', $conteudo, 'depoimentos');
    }

    public static function obterNovoDepoimento(): string
    {
        $dados = [
            'header' => 'Cadastrar Depoimento',
            'titulo' => '',
            'texto' => '',
            'status' => '',
        ];
        $conteudo = View::renderizar('usuarios/modulos/depoimentos/form', $dados);
        return parent::obterPainel('Cadastrar Depoimento - Usuário - Desafio JSL', $conteudo, 'depoimentos');
    }

    public static function definirNovoDepoimento(object $request): mixed
    {
        $postVars = $request->getPostVars();

        $obTestimony = new ModelDepoimento();
        $obTestimony->titulo = $postVars['titulo'] ?? '';
        $obTestimony->texto = $postVars['texto'] ?? '';
        $obTestimony->cadastrar();

        $request->obterRotar()->redirecionar('/usuario/depoimentos/' . $obTestimony->id . '/editar?status=criado');
    }

    public static function obterEditarDepoimento(object $request, int $id): string
    {
        $obTestimony = ModelDepoimento::obterDepoimentoPorId($id);
        if (!$obTestimony instanceof ModelDepoimento) {
            $request->obterRotar()->redirecionar('/usuario/depoimentos');
        }

        $dados = [
            'header' => 'Editar Depoimento',
            'titulo' => $obTestimony->title,
            'texto' => $obTestimony->text,
            'status' => self::obterStatus($request),
        ];
        $content = View::renderizar('usuarios/modulos/depoimentos/form', $dados);
        return parent::obterPainel('Editar Depoimento - Usuário - Desafio JSL', $content, 'depoimentos');
    }

    public static function definirEditarDepoimento(object $request, int $id): mixed
    {
        $obTestimony = ModelDepoimento::obterDepoimentoPorId($id);
        if (!$obTestimony instanceof ModelDepoimento) {
            $request->obterRotar()->redirecionar('/usuario/depoimentos');
        }

        $postVars = $request->getPostVars();
        $obTestimony->titulo = $postVars['titulo'] ?? $obTestimony->title;
        $obTestimony->texto = $postVars['texto'] ?? $obTestimony->text;
        $obTestimony->atualizar();

        $request->obterRotar()->redirecionar('/usuario/depoimentos/' . $obTestimony->id . '/editar?status=alterado');
    }

    public static function obterApagarDepoimento(object $request, int $id): string
    {
        $obTestimony = ModelDepoimento::obterDepoimentoPorId($id);
        if (!$obTestimony instanceof ModelDepoimento) {
            $request->obterRotar()->redirecionar('/usuario/depoimentos');
        }

        $dados = [
            'header' => 'Apagar Depoimento',
            'titulo' => $obTestimony->title,
            'texto' => $obTestimony->text,
        ];
        $content = View::renderizar('usuarios/modulos/depoimentos/delete', $dados);
        return parent::obterPainel('Apagar Depoimento - Usuário - Desafio JSL', $content, 'depoimentos');
    }

    public static function definirApagarDepoimento(object $request, int $id): mixed
    {
        $obTestimony = ModelDepoimento::obterDepoimentoPorId($id);
        if (!$obTestimony instanceof ModelDepoimento) {
            $request->obterRotar()->redirecionar('/usuario/depoimentos');
        }

        $obTestimony->excluir();
        $request->obterRotar()->redirecionar('/usuario/depoimentos?status=apagado');
    }
}
