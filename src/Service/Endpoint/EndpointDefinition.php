<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Service\Endpoint;

use Closure;

final class EndpointDefinition
{
    public function __construct(
        public readonly string $name,
        public readonly Closure $factory,
    ) {
    }
}
