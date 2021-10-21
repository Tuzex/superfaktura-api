<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Parameters
{
    private array $attributes;

    final public function __construct(array $attributes, OptionsResolver $resolver)
    {
        $this->attributes = $resolver->resolve($attributes);
    }

    public static function empty(): static
    {
        return new static([], new OptionsResolver());
    }

    protected function hasValues(): bool
    {
        return ! empty($this->attributes);
    }

    protected function getAttributes(): array
    {
        return $this->attributes;
    }
}
