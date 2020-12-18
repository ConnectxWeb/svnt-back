<?php


namespace App\Services\Generic\Symfony;


class SymfonyUtils
{
    static function isDev()
    {
        return $_SERVER['APP_ENV'] == 'dev';
    }
}