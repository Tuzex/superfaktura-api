<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Service\Endpoint;

use Tuzex\Superfaktura\Api\Endpoint;

interface EndpointProvider
{
    public function provide(string $name): Endpoint;
}
