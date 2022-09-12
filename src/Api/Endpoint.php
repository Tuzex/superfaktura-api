<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

use Codea\Superfaktura\Http\Response;

interface Endpoint
{
    public function call(array $options): Response;
}
