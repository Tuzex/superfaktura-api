<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Http\HttpRequest;
use Tuzex\Superfaktura\Http\MessageData;
use Tuzex\Superfaktura\Http\RelativeUrl;

final class PostHttpRequest implements HttpRequest
{
    public function __construct(
        private RelativeUrl $relativeUrl,
        private MessageData $messageData,
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return (string) $this->relativeUrl;
    }

    public function getData(): array
    {
        return [
            'body' => [
                'data' => (string) $this->messageData,
            ],
        ];
    }
}
