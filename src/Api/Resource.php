<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use ArrayIterator;
use IteratorAggregate;
use Tuzex\Superfaktura\Http\Response;

class Resource implements IteratorAggregate
{
    private ?Response $response = null;

    public function __construct(
        private Endpoint $endpoint,
        private array $options = []
    ) {
    }

    public function isOk(): bool
    {
        $response = $this->getResponse();
        $statusCode = $response->getStatusCode();

        return 200 <= $statusCode && 299 >= $statusCode;
    }

    public function hasData(): bool
    {
        return ! empty($this->getData());
    }

    public function hasErrors(): bool
    {
        return ! $this->isOk();
    }

    public function getData(): array
    {
        return $this->isOk() ? $this->getResponse()->getPayload() : [];
    }

    public function getErrors(): array
    {
        return ! $this->isOk() ? $this->getResponse()->getPayload() : [];
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->getData());
    }

    protected function addOptions(array $options): void
    {
        $this->options = array_merge($this->options, $options);
        $this->response = null;
    }

    private function getResponse(): Response
    {
        if (! $this->response) {
            $this->response = $this->endpoint->call($this->options);
        }

        return $this->response;
    }
}
