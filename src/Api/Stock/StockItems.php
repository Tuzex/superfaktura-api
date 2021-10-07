<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use ArrayIterator;
use IteratorAggregate;
use Tuzex\Superfaktura\Api\Resource;

final class StockItems implements IteratorAggregate
{
    private array $attributes = [];
    private bool $fetched = false;
    //private AttributesResolver $attributesResolver;

    public function __construct(
        private Resource $resource
    ) {
        //$this->setupAttributesResolver();
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->getAttributes());
    }

    public function getAttributes(): array
    {
        if (! $this->fetched) {
            $this->fetched = true;
            $this->attributes = array_map(
                fn (array $attributes): StockItem => StockItem::fromArray(reset($attributes)),
                $this->resource->toArray()
            );
        }

        return $this->attributes;
    }
}
