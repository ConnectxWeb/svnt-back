<?php


namespace App\Services\Generic\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Filesystem\Filesystem;

class GuzzleService
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function copyRemote($fromUrl, $toFile): ResponseInterface
    {
        $filesystem = new Filesystem();
        $dirname = dirname($toFile);
        if (!$filesystem->exists($dirname)) {
            $filesystem->mkdir($dirname);
        }
        $filesystem->touch($toFile);

        $fileHandle = fopen($toFile, "w+");
        try {
            $response = $this->client->get(
                $fromUrl,
                [
                    RequestOptions::SINK => $fileHandle,
//                RequestOptions::HEADERS => [
//                    "Authorization" => "Bearer $access_token"
//                ]
                ]
            );
        } finally {
            fclose($fileHandle);
        }

        return $response;
    }
}