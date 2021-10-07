<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Bridge\Http;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Tuzex\Superfaktura\Http\Response;

final class AsyncHttpClientResponse implements Response
{
    public function __construct(
        private ResponseInterface $response
    ) {

    }

    public function toArray(): array
    {
        return $this->response->toArray(false);
    }
}
