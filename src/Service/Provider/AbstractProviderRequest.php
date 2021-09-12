<?php

namespace App\Service\Provider;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractProviderRequest
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    protected function sendRequest(string $url, string $receipt): ResponseInterface
    {
        return $this->client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'username' => 'test',
                'password' => 'test'
            ],
            'body' => [
                'receipt' => $receipt
            ]
        ]);
    }

    abstract protected function parseResponse(ResponseInterface $response);
}
