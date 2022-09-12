<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Http;

interface Response
{
    public function getStatusCode(): int;

    public function getHeaders(): array;

    public function getPayload(): array;
}
