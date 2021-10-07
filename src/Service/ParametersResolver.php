<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Service;

use Symfony\Component\OptionsResolver\OptionsResolver;

final class ParametersResolver extends OptionsResolver
{
    public static function default(): self
    {
        return new self();
    }
}
