<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Service\Endpoint\Provider;

use InvalidArgumentException;
use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Service\Endpoint\EndpointDefinition;
use Tuzex\Superfaktura\Service\Endpoint\EndpointProvider;

final class LazyEndpointProvider implements EndpointProvider
{
    private array $factories;

    public function __construct(EndpointDefinition ...$definitions)
    {
        foreach ($definitions as $definition) {
            $this->factories[$definition->name] = $definition->factory;
        }
    }

    public function provide(string $name): Endpoint
    {
        return array_key_exists($name, $this->factories)
            ? $this->factories[$name]()
            : throw new InvalidArgumentException(sprintf('Endpoint "%s" not found.', $name));
    }
}
