<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api\Stock\Filter;

use Codea\Superfaktura\Api\Filter;

final class OnStock implements Filter
{
    public function getCriteria(): array
    {
        return [
            'status' => 1,
        ];
    }
}
