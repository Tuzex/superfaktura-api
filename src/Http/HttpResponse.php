<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

interface HttpResponse
{
    public function isSuccessful(): bool;

    public function isFailing(): bool;

    public function getStatusCode(): int;

    public function getHeaders(): array;

    public function getPayload(): array;
}
