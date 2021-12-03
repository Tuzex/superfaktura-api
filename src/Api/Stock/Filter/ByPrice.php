<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock\Filter;

use Tuzex\Superfaktura\Api\Filter;

final class ByPrice implements Filter
{
    public function __construct(
        private float $priceFrom,
        private float $priceTo = 0.0
    ) {
    }

    public function getCriteria(): array
    {
        $options = [
            'price_from' => $this->priceFrom,
            'price_to' => $this->priceTo,
        ];

        return array_filter($options, fn (float $limit): bool => $limit > 0);
    }
}
