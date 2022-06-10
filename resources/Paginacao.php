<?php

declare(strict_types=1);

namespace Resources;

final class Paginacao
{
    private $limit;
    private $retorno;
    private $pages;
    private $currentPage;

    public function __construct($retorno, $currentPage = 1, $limit = 10)
    {
        $this->results = $retorno;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) && $currentPage > 0) ? $currentPage : 1;
        $this->calcular();
    }

    private function calcular()
    {
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    public function obterLimite()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset . ',' . $this->limit;
    }

    public function obterPaginas()
    {
        if ($this->pages === 1) return [];
        $pages = [];
        for ($i = 1; $i <= $this->pages; $i++) {
            $pages[] = [
                'pagina' => $i,
                'ativo' => $i === intval($this->currentPage),
            ];
        }
        return $pages;
    }
}
