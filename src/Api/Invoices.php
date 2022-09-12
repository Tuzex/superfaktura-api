<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

use Codea\Superfaktura\Api\Invoices\GetListOfInvoices;
use Codea\Superfaktura\Http\HttpClient;

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
