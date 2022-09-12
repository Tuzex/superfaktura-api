<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Service\Endpoint\Provider;

use Codea\Superfaktura\Api\Endpoint;
use Codea\Superfaktura\Service\Endpoint\EndpointDefinition;
use Codea\Superfaktura\Service\Endpoint\EndpointProvider;

final class PersistentEndpointProvider implements EndpointProvider
{
    private array $endpoints = [];

    public function __construct(
        private EndpointProvider $endpointProvider
    ) {
    }

    public static function setup(EndpointDefinition ...$definitions): self
    {
        return new self(
            new LazyEndpointProvider(...$definitions)
        );
    }

    public function provide(string $name): Endpoint
    {
        return $this->endpoints[$name]
            ?? $this->endpoints[$name] = $this->endpointProvider->provide($name);
    }
}
