<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Tuzex\Superfaktura\Api\Stock\GetListOfStockItems;
use Tuzex\Superfaktura\Api\Stock\ViewStockItemDetails;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Service\Endpoint\EndpointDefinition;
use Tuzex\Superfaktura\Service\Endpoint\EndpointProvider;
use Tuzex\Superfaktura\Service\Endpoint\Provider\PersistentEndpointProvider;

final class Stock
{
    private EndpointProvider $endpointProvider;

    public function __construct(
        private HttpClient $httpClient
    ) {
        $this->endpointProvider = PersistentEndpointProvider::setup(
            new EndpointDefinition(GetListOfStockItems::class, fn () => new GetListOfStockItems($this->httpClient))
        );
    }

    public function listItems(array $options = []): Collection
    {
        return new Collection($this->endpointProvider->provide(GetListOfStockItems::class), $options);
    }

    public function searchItems(string $keyword, array $options = []): Collection
    {
        $endpoint = $this->endpointProvider->provide(GetListOfStockItems::class);
        $options = array_merge($options, [
            'search' => $keyword,
        ]);

        return new Collection($endpoint, $options);
    }

    public function searchItemsBySku(string $sku, array $options = []): Collection
    {
        $endpoint = $this->endpointProvider->provide(GetListOfStockItems::class);
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
