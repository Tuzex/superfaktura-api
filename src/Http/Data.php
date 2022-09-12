<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Http;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Data
{
    private array $attributes;

    public function __construct(OptionsResolver $resolver, array $attributes = [])
    {
        $this->attributes = $resolver->resolve($attributes);
    }

    public function hasAttributes(): bool
    {
        return ! empty($this->attributes);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
