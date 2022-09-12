<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

interface Filter
{
    public function getCriteria(): array;
}
