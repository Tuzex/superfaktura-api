<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Tuzex\Superfaktura\Api\Invoices\GetListOfInvoices;
use Tuzex\Superfaktura\Http\HttpClient;

final class Invoices
{
    public function __construct(
        private HttpClient $httpClient
    ) {
    }

    public function list(array $options = []): Collection
    {
        return new Collection(
            new GetListOfInvoices($this->httpClient)
        );
    }
}
