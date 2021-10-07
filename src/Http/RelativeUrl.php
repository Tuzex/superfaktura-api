<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class RelativeUrl implements Stringable
{
    private string $url;

    public function __construct(string $resource)
    {
        $this->url = sprintf('/%s', trim($resource, '/'));
    }

    public function __toString(): string
    {
        return $this->url;
    }

    public function addQueryString(QueryString $query): void
    {
        $this->url = sprintf('%s%s', $this->url, $query);
    }
}
