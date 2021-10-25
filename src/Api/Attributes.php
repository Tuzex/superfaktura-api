<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Attributes
{
    private array $options;

    final public function __construct(OptionsResolver $resolver, array $options = [])
    {
        $this->options = $resolver->resolve($options);
    }

    public static function empty(): self
    {
        return new static(new OptionsResolver(), []);
    }

    public function hasOptions(): bool
    {
        return ! empty($this->options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
