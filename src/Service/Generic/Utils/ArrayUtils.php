<?php


namespace App\Service\Generic\Utils;


class ArrayUtils
{
    static public function computeArrayPercent(array $list, int $roundPrecision = 0)
    {
        $count = count($list);
        if ($count === 0) {
            return 0;
        }
        return round(array_sum($list) / $count, $roundPrecision);
    }
}