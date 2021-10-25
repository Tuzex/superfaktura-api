<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;
use Tuzex\Superfaktura\Api\Attributes;

final class MessageBody extends Attributes implements Stringable
{
    public function __toString(): string
    {
        return (string) json_encode($this->getOptions(), JSON_THROW_ON_ERROR);
    }
}
