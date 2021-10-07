<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;
use Tuzex\Superfaktura\Service\ParametersResolver;

abstract class Parameters
{
    private array $values;

    public function __construct(array $values, ParametersResolver $resolver)
    {
        $this->values = $resolver->resolve($values);
    }

    protected function getValues(): array
    {
        return $this->values;
    }
}
