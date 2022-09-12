<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Http;

use Stringable;

final class QueryString extends Data implements Stringable
{
    public function __toString(): string
    {
        if (! $this->hasAttributes()) {
            return '';
        }

        return sprintf('/%s', $this->stringifyAttributes());
    }

    private function stringifyAttributes(): string
    {
        $attributes = $this->getAttributes();
        $parameterizedAttributes = array_map(
            fn (string $key, $value): string => urlencode(sprintf('%s:%s', $key, $value)),
            array_keys($attributes),
            $attributes,
        );

        return implode('/', $parameterizedAttributes);
    }
}
