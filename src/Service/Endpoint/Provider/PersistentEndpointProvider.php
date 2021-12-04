<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Service\Endpoint\Provider;

use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Service\Endpoint\EndpointDefinition;
use Tuzex\Superfaktura\Service\Endpoint\EndpointProvider;

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
