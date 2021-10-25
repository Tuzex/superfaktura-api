<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;
use Tuzex\Superfaktura\Api\Attributes;

final class QueryString extends Attributes implements Stringable
{
    public function __toString(): string
    {
        if (! $this->hasOptions()) {
            return '';
        }

        return sprintf('/%s', $this->stringifyOptions());
    }

    private function stringifyOptions(): string
    {
        $options = $this->getOptions();
        $parameterizedOptions = array_map(
            fn (string $key, $value): string => urlencode(sprintf('%s:%s', $key, $value)),
            array_keys($options),
            $options,
        );

        return implode('/', $parameterizedOptions);
    }
}
