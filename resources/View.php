<?php

declare(strict_types=1);

namespace Resources;

final class View
{
    private static $vars = [];

    private static function obterConteudoView(string $view): string
    {
        $file = __DIR__ . '/../src/View/' . $view . '.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function renderizar(string $view, array $vars = []): string
    {
        $contentView = self::obterConteudoView($view);
        $vars = array_merge(self::$vars, $vars);
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);
        return str_replace($keys, array_values($vars), $contentView);
    }

    public static function iniciar($vars = [])
    {
        self::$vars = $vars;
    }
}
