<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Service\Endpoint;

use Codea\Superfaktura\Api\Endpoint;

interface EndpointProvider
{
    public function provide(string $name): Endpoint;
}
