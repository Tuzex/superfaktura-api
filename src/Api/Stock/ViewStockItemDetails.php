<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api\Stock;

use Codea\Superfaktura\Api\Endpoint;
use Codea\Superfaktura\Api\GetEndpoint;
use Codea\Superfaktura\Api\Uri;
use Codea\Superfaktura\Http\HttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
