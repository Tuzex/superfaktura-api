<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock\Filter;

use Tuzex\Superfaktura\Api\Criteria;

final class OnStock implements Criteria
{
    public function getOptions(): array
    {
        return [
            'status' => 1,
        ];
    }
}
