<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

interface Filter
{
    public function getCriteria(): array;
}
