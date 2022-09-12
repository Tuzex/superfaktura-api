<?php

declare(strict_types=1);

namespace Codea\Superfaktura;

use Codea\Superfaktura\Api\Invoices;
use Codea\Superfaktura\Api\Stock;

final class NativeApiClient implements ApiClient
{
    public function __construct(
        private Invoices $invoices,
        private Stock $stock,
    ) {
    }

    public function invoices(): Invoices
    {
        return $this->invoices;
    }

    public function stock(): Stock
    {
        return $this->stock;
    }
}
