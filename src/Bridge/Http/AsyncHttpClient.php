<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Bridge\Http;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Request\PostRequest;
use Tuzex\Superfaktura\Http\Response;

final class AsyncHttpClient implements HttpClient
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {
    }

    public function get(GetRequest $request): Response
    {
        return new AsyncHttpClientResponse(
            $this->httpClient->request('GET', $request->getUrl())
        );
    }

    public function post(PostRequest $request): Response
    {
        $options = [
            'body' => [
                'data' => $request->getMessage(),
            ],
        ];

        return new AsyncHttpClientResponse(
            $this->httpClient->request('POST', $request->getUrl(), $options)
        );
    }
}
