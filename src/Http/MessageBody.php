<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Parameters;

use Stringable;
use Tuzex\Superfaktura\Http\Parameters;

final class MessageBody extends Parameters implements Stringable
{
    public function __toString(): string
    {
        return (string) json_encode($this->getValues());
    }
}
