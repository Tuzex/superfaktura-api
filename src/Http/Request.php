<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

interface Request
{
    public function getUrl(): string;
}
