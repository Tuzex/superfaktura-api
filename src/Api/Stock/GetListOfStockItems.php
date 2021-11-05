<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Api\GetEndpoint;
use Tuzex\Superfaktura\Api\OptionsResolverBuilder;
use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\HttpClient;

final class GetListOfStockItems extends GetEndpoint implements Endpoint
{
    public function __construct(HttpClient $httpClient)
    {
        $optionsResolverBuilder = new OptionsResolverBuilder();
        $optionsResolverBuilder->addPagination()
            ->addSorting()
            ->addListInfo()
            ->addCustom(
                function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->define('search')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value));

                    $optionsResolver->define('sku')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value));

                    $optionsResolver->define('price_from')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= 0.0);

                    $optionsResolver->define('price_to')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= $optionsResolver->offsetGet('price_from'));

                    $optionsResolver->define('status')
                        ->allowedTypes('int')
                        ->allowedValues(1);
                }
            );

        parent::__construct($httpClient, $optionsResolverBuilder->build(), new Uri('stock_items/index.json'));
    }
}
