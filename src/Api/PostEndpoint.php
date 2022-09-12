<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

use Codea\Superfaktura\Http\HttpClient;
use Codea\Superfaktura\Http\MessageBody;
use Codea\Superfaktura\Http\Request\PostRequest;
use Codea\Superfaktura\Http\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
