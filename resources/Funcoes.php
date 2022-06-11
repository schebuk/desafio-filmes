<?php

declare(strict_types=1);

namespace Resources;

final class Funcoes
{
    public function limitarCaracteres($string, $limite, $break = true): string
    {
        $tamanho = strlen($string);
        if ($tamanho <= $limite) {
            $novaString = $string;
        } else {
            if ($break === true) {
                $novaString = trim(substr($string, 0, $limite)) . "...";
            } else {
                $ultimoEspaco = strrpos(substr($string, 0, $limite), " ");
                $novaString = trim(substr($string, 0, $ultimoEspaco)) . "...";
            }
        }
        return $novaString; // use -> limitarCaracteres($string, 120, false);
    }
}
