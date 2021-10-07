<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Symfony\Component\OptionsResolver\OptionsResolver;

final class AttributesResolver extends OptionsResolver
{
    public static function default(): self
    {
        return new self();
    }
}
