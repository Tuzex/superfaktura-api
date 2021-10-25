<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Stringable;

final class Uri implements Stringable
{
    private string $path;
    private array $parameters;

    public function __construct(string $path, array $parameters = [])
    {
        $this->path = sprintf('/%s', trim($path, '/'));
        $this->parameters = $parameters;
    }

    public function __toString(): string
    {
        return strtr($this->path, $this->parameters);
    }
}
