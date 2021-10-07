<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class QueryString extends Parameters implements Stringable
{
    public function __toString(): string
    {
        if (!empty($this->parameters)) {
            return '';
        }

        $queryString = http_build_query($this->getValues(), arg_separator: '/');
        $queryArguments = str_replace('=', ':', $queryString);

        return sprintf('/%s', $queryArguments);
    }
}
