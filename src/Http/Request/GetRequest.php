<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\RelativeUrl;
use Tuzex\Superfaktura\Http\Request;

abstract class GetRequest implements Request
{
    public function __construct(
        private RelativeUrl $relativeUrl,
        private QueryString $queryString,
    ) {
    }

    public function getUrl(): string
    {
        $this->relativeUrl->addQueryString($this->queryString);

        return (string) $this->relativeUrl;
    }
}
