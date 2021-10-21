<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

interface HttpRequest
{
    public function getMethod(): string;

    public function getUrl(): string;

    public function getData(): array;
}
