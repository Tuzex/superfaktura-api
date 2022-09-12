<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api\Invoices;

use Codea\Superfaktura\Api\Endpoint;
use Codea\Superfaktura\Api\GetEndpoint;
use Codea\Superfaktura\Api\OptionsResolverBuilder;
use Codea\Superfaktura\Api\Uri;
use Codea\Superfaktura\Http\HttpClient;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class GetListOfInvoices extends GetEndpoint implements Endpoint
{
    public function __construct(HttpClient $httpClient)
    {
        $optionsResolverBuilder = new OptionsResolverBuilder();
        $optionsResolverBuilder->enableSorting()
            ->enablePagination()
            ->allowListInfo()
            ->setCustom(
                function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->define('type')
                        ->allowedTypes('string')
                        ->default('regular');

                    $optionsResolver->define('amount_from')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= 0.0);

                    $optionsResolver->define('amount_to')
                        ->allowedTypes('float')
                        ->allowedValues(fn (float $value): bool => $value >= $optionsResolver->offsetGet('amount_from'));

                    $optionsResolver->define('client_id')
                        ->allowedTypes('int');

                    $optionsResolver->define('ignore')
                        ->allowedTypes('string', 'int');

                    $optionsResolver->define('order_no')
                        ->allowedTypes('string');

                    $optionsResolver->define('search')
                        ->allowedTypes('string')
                        ->normalize(fn (Options $options, string $value): string => base64_encode($value));

                    $optionsResolver->define('tag')
                        ->allowedTypes('int');
                }
            );

        parent::__construct($httpClient, $optionsResolverBuilder->build(), new Uri('invoices/index.json'));
    }
}
