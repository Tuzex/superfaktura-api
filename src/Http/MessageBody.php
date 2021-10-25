<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Stringable;
use Tuzex\Superfaktura\Api\Attributes;

final class MessageBody extends Attributes implements Stringable
{
    public function __toString(): string
    {
        $json = json_encode($this->getOptions());
        if (! $json) {
        }

        return $json;
    }
}
