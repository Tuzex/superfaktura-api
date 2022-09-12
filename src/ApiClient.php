<?php

declare(strict_types=1);

namespace Codea\Superfaktura;

use Codea\Superfaktura\Api\Invoices;
use Codea\Superfaktura\Api\Stock;

interface ApiClient
{
    public function invoices(): Invoices;

    public function stock(): Stock;
}
