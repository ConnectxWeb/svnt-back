<?php


namespace App\Service\Generic\Api;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class ApiClient
{
    /**
     * @var HttpClient
     */
    private $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function request($url, $method = 'GET')
    {
        try {
            $response = $this->client->request($method, $url);
        } catch (TransportExceptionInterface $e) {
            return false;
        }

        try {
            if ($response->getStatusCode() !== 200) {
                return false;
            }
        } catch (TransportExceptionInterface $e) {
            return false;
        }

        try {
            $result = $response->toArray();
        } catch (ClientExceptionInterface $e) {
            return false;
        } catch (DecodingExceptionInterface $e) {
            return false;
        } catch (RedirectionExceptionInterface $e) {
            return false;
        } catch (ServerExceptionInterface $e) {
            return false;
        } catch (TransportExceptionInterface $e) {
            return false;
        }

        return $result;
    }
}