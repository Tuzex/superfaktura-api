<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Api\GetEndpoint;
use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\HttpClient;

final class ViewStockItemDetails extends GetEndpoint implements Endpoint
{
    public function __construct(HttpClient $httpClient, int $id)
    {
        $uri = new Uri('/stock_items/view/{ID}', [
            '{ID}' => $id,
        ]);

        parent::__construct($httpClient, new OptionsResolver(), $uri);
    }
}
