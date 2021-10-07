<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Http\Parameters\MessageBody;
use Tuzex\Superfaktura\Http\RelativeUrl;
use Tuzex\Superfaktura\Http\Request;

abstract class PostRequest implements Request
{
    public function __construct(
        private RelativeUrl $relativeUrl,
        private MessageBody $messageBody,
    ) {
    }

    public function getUrl(): string
    {
        return (string) $this->relativeUrl;
    }

    public function getMessage(): string
    {
        return (string) $this->messageBody;
    }
}
