<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request;

use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\MessageBody;
use Tuzex\Superfaktura\Http\Request;

final class PostRequest implements Request
{
    public function __construct(
        private Uri $uri,
        private MessageBody $messageData,
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return (string) $this->uri;
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
