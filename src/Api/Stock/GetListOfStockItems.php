<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Stock;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Api\OptionsResolverBuilder;
use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Response;

final class GetListOfStockItems implements Endpoint
{
    private Uri $uri;
    private OptionsResolver $optionsResolver;

    public function __construct(
        private HttpClient $httpClient,
    ) {
        $optionsResolverBuilder = new OptionsResolverBuilder();
        $optionsResolverBuilder->addPagination()
            ->addSorting()
            ->addListInfo()
            ->setCustom(
                function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->define('search')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value))
                        ->info('Searches in fields: name, SKU, description');

                    $optionsResolver->define('sku')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value))
                        ->info('Search by SKU');

                    $optionsResolver->define('price_from')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= 0.0)
                        ->info('Price from');

                    $optionsResolver->define('price_to')
                        ->allowedTypes('float')
                        ->allowedValues(
                            fn (float $value): bool => $value >= 0.0 && $value > $optionsResolver->offsetGet('price_from')
                        )
                        ->info('Price to');

                    $optionsResolver->define('status')
                        ->allowedTypes('int')
                        ->allowedValues(1)
                        ->info('Shows only items that are in stock (1=yes)');
                }
            );

        $this->uri = new Uri('stock_items/index.json');
        $this->optionsResolver = $optionsResolverBuilder->build();
    }

    /**
     * @param array $options {
     *
     * @var int sorting type, ASC or DESC [default: DESC]
     *          }
     */
    public function call(array $options = []): Response
    {
        return $this->httpClient->send(
            new GetRequest($this->uri, new QueryString($this->optionsResolver, $options))
        );
    }
}
