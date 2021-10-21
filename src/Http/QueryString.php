<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class QueryString extends Parameters implements Stringable
{
    public function __toString(): string
    {
        if (! $this->hasValues()) {
            return '';
        }

        return sprintf('/%s', $this->stringifyValues());
    }

    private function stringifyValues(): string
    {
        $values = $this->getAttributes();
        $parametrizedValues = array_map(
            fn (string $key, $value): string => urlencode(sprintf('%s:%s', $key, $value)),
            array_keys($values),
            $values
        );

        return implode('/', $parametrizedValues);
    }
}
