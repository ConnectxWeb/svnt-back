<?php


namespace App\Service\Generic\Type;


class BootstrapType
{
    const INFO = "info";
    const SUCCESS = "success";
    const WARNING = "warning";
    const DANGER = "danger";

    public static function isValidType(?string $type)
    {
        return in_array($type, [self::INFO, self::WARNING, self::SUCCESS, self::DANGER]);
    }
}