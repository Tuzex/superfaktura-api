<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

use Codea\Superfaktura\Http\HttpClient;
use Codea\Superfaktura\Http\QueryString;
use Codea\Superfaktura\Http\Request\GetRequest;
use Codea\Superfaktura\Http\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
