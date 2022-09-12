<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Http\Request;

use Codea\Superfaktura\Api\Uri;
use Codea\Superfaktura\Http\QueryString;
use Codea\Superfaktura\Http\Request;

final class GetRequest implements Request
{
    public function __construct(
        private Uri $uri,
        private QueryString $queryString,
    ) {
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return sprintf('%s%s', $this->uri, $this->queryString);
    }

    public function getData(): array
    {
        return [];
    }
}
