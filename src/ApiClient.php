<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura;

use Tuzex\Superfaktura\Api\Invoices;
use Tuzex\Superfaktura\Api\Stock;

interface ApiClient
{
    public function invoices(): Invoices;

    public function stock(): Stock;
}
