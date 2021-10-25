<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Tuzex\Superfaktura\Api\Stock\GetListOfStockItems;
use Tuzex\Superfaktura\Api\Stock\ViewStockItemDetails;
use Tuzex\Superfaktura\Http\HttpClient;

final class Stock
{
    public function __construct(
        private HttpClient $httpClient
    ) {
    }

    public function listItems(array $options = []): Collection
    {
        $endpoint = new GetListOfStockItems($this->httpClient);

        return new Collection($endpoint, $options);
    }

    public function searchItems(string $keyword, array $options = []): Collection
    {
        $endpoint = new GetListOfStockItems($this->httpClient);
        $options = array_merge($options, [
            'search' => $keyword,
        ]);

        return new Collection($endpoint, $options);
    }

    public function searchItemsBySku(string $sku, array $options = []): Collection
    {
        $endpoint = new GetListOfStockItems($this->httpClient);
        $options = array_merge($options, [
            'sku' => $sku,
        ]);

        return new Collection($endpoint, $options);
    }

    public function getItem(int $id): Resource
    {
        return new Resource(
            new ViewStockItemDetails($this->httpClient, $id)
        );
    }
}
