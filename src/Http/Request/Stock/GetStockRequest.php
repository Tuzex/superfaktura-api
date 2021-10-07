<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Http\Request\Stock;

use Tuzex\Superfaktura\Http\QueryString;
use Tuzex\Superfaktura\Http\RelativeUrl;
use Tuzex\Superfaktura\Http\Request;
use Tuzex\Superfaktura\Http\Request\GetRequest;
use Tuzex\Superfaktura\Service\ParametersResolver;

final class GetStockRequest extends GetRequest implements Request
{
    public function __construct(array $parameters = [])
    {
        $parametersResolver = ParametersResolver::default();
        /*
         * @todo SETUP
         */

        parent::__construct(
            new RelativeUrl('stock_items/index.json'),
            new QueryString($parameters, $parametersResolver),
        );
    }
}
