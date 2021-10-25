<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\Request;

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
