<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Http\HttpRequest;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\RelativeUrl;

final class GetHttpRequest implements HttpRequest
{
    public function __construct(
        private RelativeUrl $relativeUrl,
        private QueryString $queryString,
    ) {
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUrl(): string
    {
        return (string) $this->relativeUrl->extend($this->queryString);
    }

    public function getData(): array
    {
        return [];
    }
}
