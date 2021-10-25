<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api\Invoices;

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
                        ->info('Type of document (proforma, regular, ...). Use | as separator for multiple values.');
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
