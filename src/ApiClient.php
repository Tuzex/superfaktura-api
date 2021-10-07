<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura;

use Tuzex\Superfaktura\Api\Stock;

interface ApiClient
{
    public function stock(): Stock;
}
