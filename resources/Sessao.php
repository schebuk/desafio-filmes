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
        $_SESSION['user'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email,
        ];
        return true;
    }

    public static function estaLogado()
    {
        self::iniciar();

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_destroy();
            unset($_SESSION['user']);
        }
        $_SESSION['LAST_ACTIVITY'] = time();

        return isset($_SESSION['user']['id']);
    }

    public static function logout(): bool
    {
        self::iniciar();

        if (isset($_SESSION['user'])) {
            session_destroy();
            unset($_SESSION['user']);
            return true;
        }
        return false;
    }
}
