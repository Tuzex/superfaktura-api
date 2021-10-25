<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Attributes
{
    private array $options;

    public function __construct(OptionsResolver $resolver, array $options = [])
    {
        $this->options = $resolver->resolve($options);
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
