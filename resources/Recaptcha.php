<?php

declare(strict_types=1);

namespace Resources;

final class Recaptcha
{
    public function obtemRecaptcha($secretKey)
    {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="
            . SECRET_KEY . "&response={$secretKey}");
        $retorno = json_decode($response);
        return $retorno;
    }
}
