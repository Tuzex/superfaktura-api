<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;

final class MessageData extends Parameters implements Stringable
{
    public function __toString(): string
    {
        return (string) json_encode($this->getAttributes());
    }
}
