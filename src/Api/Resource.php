<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

interface Resource
{
    public function toArray(): array;
}
