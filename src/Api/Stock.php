<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

use Codea\Superfaktura\Api\Stock\GetListOfStockItems;
use Codea\Superfaktura\Api\Stock\ViewStockItemDetails;
use Codea\Superfaktura\Http\HttpClient;
use Codea\Superfaktura\Service\Endpoint\EndpointDefinition;
use Codea\Superfaktura\Service\Endpoint\EndpointProvider;
use Codea\Superfaktura\Service\Endpoint\Provider\PersistentEndpointProvider;

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
