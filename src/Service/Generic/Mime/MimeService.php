<?php


namespace App\Service\Generic\Mime;


class MimeService
{
    public static function isImage(?string $mime)
    {
        return in_array($mime, self::mimeImages());
    }

    public static function isVideo(?string $mime)
    {
        return in_array($mime, self::mimeVideo());
    }

    public static function isAudio(?string $mime)
    {
        return in_array($mime, self::mimeAudio());
    }

    public static function mimeImages()
    {
        return [
            'image/gif',
            'image/jpeg',
            'image/png',
            'image/psd',
            'image/bmp',
            'image/tiff',
            'image/jp2',
            'image/iff',
            'image/vnd.wap.wbmp',
            'image/xbm',
            'image/vnd.microsoft.icon',
            'image/webp',
        ];
    }

    public static function mimeAudio()
    {
        return [
            "audio/flac",
            "audio/mpegurl",
            "audio/mp4",
            "audio/mpeg",
            "audio/ogg",
            "audio/x-scpls",
            "audio/wav",
            "audio/webm",
            "audio/x-ms-wma",
        ];
    }

    public static function mimeVideo()
    {
        return [
            'application/annodex',
            'application/mp4',
            'application/ogg',
            'application/vnd.rn-realmedia',
            'application/x-matroska',
            'video/3gpp',
            'video/3gpp2',
            'video/annodex',
            'video/divx',
            'video/flv',
            'video/h264',
            'video/mp4',
            'video/mp4v-es',
            'video/mpeg',
            'video/mpeg-2',
            'video/mpeg4',
            'video/ogg',
            'video/ogm',
            'video/quicktime',
            'video/ty',
            'video/vdo',
            'video/vivo',
            'video/vnd.rn-realvideo',
            'video/vnd.vivo',
            'video/webm',
            'video/x-bin',
            'video/x-cdg',
            'video/x-divx',
            'video/x-dv',
            'video/x-flv',
            'video/x-la-asf',
            'video/x-m4v',
            'video/x-matroska',
            'video/x-motion-jpeg',
            'video/x-ms-asf',
            'video/x-ms-dvr',
            'video/x-ms-wm',
            'video/x-ms-wmv',
            'video/x-msvideo',
            'video/x-sgi-movie',
            'video/x-tivo',
            'video/avi',
            'video/x-ms-asx',
            'video/x-ms-wvx',
            'video/x-ms-wmx',
        ];
    }
}