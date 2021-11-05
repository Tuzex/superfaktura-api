<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Response;

abstract class GetEndpoint implements Endpoint
{
    public function __construct(
        private HttpClient $httpClient,
        private OptionsResolver $optionsResolver,
        private Uri $uri,
    ) {
    }

    public function call(array $options): Response
    {
        return $this->httpClient->send(
            new GetRequest($this->uri, new QueryString($this->optionsResolver, $options))
        );
    }
}
