<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class RelativeUrl implements Stringable
{
    private string $path;

    public function __construct(string $path, array $parameters = [])
    {
        $this->path = sprintf('/%s', strtr(trim($path, '/'), $parameters));
    }

    public function __toString(): string
    {
        return $this->path;
    }

    public function extend(QueryString $query): self
    {
        return new self(sprintf('%s%s', $this->path, $query));
    }
}
