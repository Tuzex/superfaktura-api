<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Tuzex\Superfaktura\Http\Response;

interface Endpoint
{
    public function call(array $options): Response;
}
