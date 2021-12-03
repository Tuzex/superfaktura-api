<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock\Filter;

use Tuzex\Superfaktura\Api\Filter;

final class OnStock implements Filter
{
    public function getCriteria(): array
    {
        return [
            'status' => 1,
        ];
    }
}
