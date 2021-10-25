<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

interface Request
{
    public function getMethod(): string;

    public function getUri(): string;

    public function getData(): array;
}
