<?php


namespace App\Service\Generic\Symfony;


class SymfonyUtils
{
    static function isDev()
    {
        return $_SERVER['APP_ENV'] == 'dev';
    }
}