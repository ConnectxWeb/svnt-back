<?php
/**
 * This code is open source and licensed under the MIT License
 * Author: Benjamin Leveque <info@connectx.fr>
 * Copyright (c) - connectX
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Service\Generic\Api;


use Symfony\Component\HttpClient\HttpClient;

//symfony >= 4.3 -  composer require symfony/http-client
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
        } catch (ClientExceptionInterface | DecodingExceptionInterface $e) {
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