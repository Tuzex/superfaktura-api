<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http;

use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Request\PostRequest;

interface HttpClient
{
    public function get(GetRequest $request): Response;

    public function post(PostRequest $request): Response;
}
