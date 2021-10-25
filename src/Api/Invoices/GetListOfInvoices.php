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
