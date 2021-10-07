<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Tuzex\Superfaktura\Api\Stock\StockItems;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\Request\Stock\GetStockRequest;

final class Stock
{
    public function __construct(
        private HttpClient $httpClient,
    ) {
        
    }

//    public function addItem()
//    {
//
//    }

    public function getItems(array $parameters = []): StockItems
    {
        return new StockItems(
            $this->httpClient->get(
                new GetStockRequest($parameters)
            )
        );
    }

//    public function getItemBySku($sku)
//    {
//        return new StockItem($this->httpClient, ['sku' => $sku]);
//    }
//
//    public function deleteItem()
//    {
//
//    }
}
