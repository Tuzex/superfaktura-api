<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\MessageBody;
use Tuzex\Superfaktura\Http\Request\PostRequest;
use Tuzex\Superfaktura\Http\Response;

abstract class PostEndpoint implements Endpoint
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
            new PostRequest($this->uri, new MessageBody($this->optionsResolver, $options))
        );
    }
}
