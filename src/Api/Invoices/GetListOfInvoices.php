<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Invoices;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tuzex\Superfaktura\Api\Endpoint;
use Tuzex\Superfaktura\Api\OptionsResolverBuilder;
use Tuzex\Superfaktura\Api\Uri;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Http\Response;

final class GetListOfInvoices implements Endpoint
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
                    $optionsResolver->define('type')
                        ->allowedTypes('string')
                        ->default('regular')
                        ->info('Type of document (proforma, regular, ...). Use "|" as separator for multiple values.');

                    $optionsResolver->define('amount_from')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= 0.0)
                        ->info('Amount from');

                    $optionsResolver->define('amount_to')
                        ->allowedTypes('float')
                        ->allowedValues(
                            fn (float $value): bool => $value >= 0.0 && $value > $optionsResolver->offsetGet('amount_from')
                        )
                        ->info('Amount to');

                    $optionsResolver->define('client_id')
                        ->allowedTypes('int')
                        ->info('Client ID');

                    $optionsResolver->define('ignore')
                        ->allowedTypes('string', 'int')
                        ->info('IDs of invoices to be ignored. Use "|" as separator for multiple values.');

                    $optionsResolver->define('order_no')
                        ->allowedTypes('string')
                        ->info('Order number, from which invoice is created');

                    $optionsResolver->define('search')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value))
                        ->info('Search string');

                    $optionsResolver->define('tag')
                        ->allowedTypes('int')
                        ->info('Tag ID');
                }
            );

        $this->uri = new Uri('invoices/index.json');
        $this->optionsResolver = $optionsResolverBuilder->build();
    }

    public function call(array $options): Response
    {
        return $this->httpClient->send(
            new GetRequest($this->uri, new QueryString($this->optionsResolver, $options))
        );
    }
}
