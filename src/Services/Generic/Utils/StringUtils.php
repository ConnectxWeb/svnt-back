<?php


namespace App\Service\Generic\Utils;


class StringUtils
{
    static function javascriptEscape($str)
    {
        $new_str = '';

        $str_len = strlen($str);
        for ($i = 0; $i < $str_len; $i++) {
            $new_str .= '\\x' . sprintf('%02x', ord(substr($str, $i, 1)));
        }

        return $new_str;
    }

    static function removeAllUrls($str)
    {
        $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@";

        return preg_replace($regex, ' ', $str);
    }
}