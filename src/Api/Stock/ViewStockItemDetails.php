<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Response;

final class ViewStockItemDetails implements Endpoint
{
    private Uri $uri;

    public function __construct(
        private HttpClient $httpClient,
        int $id,
    ) {
        $this->uri = new Uri('/stock_items/view/{ID}', [
            '{ID}' => $id,
        ]);
    }

    public function call(array $options = []): Response
    {
        return $this->httpClient->send(
            new GetRequest($this->uri, QueryString::empty())
        );
    }
}
