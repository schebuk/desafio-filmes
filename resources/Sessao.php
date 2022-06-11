<?php

declare(strict_types=1);

namespace Resources;

class Sessao
{
    private static function iniciar()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($obUser): bool
    {
        self::iniciar();
        $_SESSION['usuario'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email,
            'status' => $obUser->status,
            'funcao' => $obUser->funcao,
        ];
        return true;
    }

    public static function obter($valor): ?string
    {
        if (isset($_SESSION[$valor])) {
            return $_SESSION[$valor];
        }
        return null;
    }

    public static function estaLogado()
    {
        self::iniciar();

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_destroy();
            unset($_SESSION['usuario']);
        }
        $_SESSION['LAST_ACTIVITY'] = time();

        return isset($_SESSION['usuario']['id']);
    }

    public static function logout(): bool
    {
        self::iniciar();

        if (isset($_SESSION['usuario'])) {
            session_destroy();
            unset($_SESSION['usuario']);
            return true;
        }
        return false;
    }
}
