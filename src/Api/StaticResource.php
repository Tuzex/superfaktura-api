<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

final class StaticResource implements Resource
{
    public function __construct(
        private array $data
    ) {
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
