<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Service\Endpoint\Provider;

use Codea\Superfaktura\Api\Endpoint;
use Codea\Superfaktura\Service\Endpoint\EndpointDefinition;
use Codea\Superfaktura\Service\Endpoint\EndpointProvider;
use InvalidArgumentException;

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
