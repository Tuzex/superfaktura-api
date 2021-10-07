<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use Tuzex\Superfaktura\Api\Resource;
use Tuzex\Superfaktura\Api\StaticResource;

final class StockItem
{
    private array $attributes = [];

    public function __construct(
        private Resource $resource,
    ) {
    }

    public static function fromArray(array $attributes): self
    {
        return new self(
            new StaticResource($attributes)
        );
    }

    public function editItem()
    {
    }

    public function getAttributes(): array
    {
        return $this->resource->toArray();
    }
}
