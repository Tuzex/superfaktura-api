<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class MessageBody extends Data implements Stringable
{
    public function __toString(): string
    {
        return (string) json_encode($this->getAttributes(), JSON_THROW_ON_ERROR);
    }
}
