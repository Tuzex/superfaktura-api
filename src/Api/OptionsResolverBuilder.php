<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Closure;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OptionsResolverBuilder
{
    /**
     * @var array<int, Closure>
     */
    private array $configurators = [];

    public function setCustom(Closure $configurator): self
    {
        $this->configurators[] = $configurator;

        return $this;
    }

    public function allowListInfo(): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver): void {
                $optionsResolver->define('listinfo')
                    ->allowedTypes('int')
                    ->allowedValues(0, 1);
            }
        );

        return $this;
    }

    public function enablePagination(): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver): void {
                $optionsResolver->define('page')
                    ->allowedTypes('int')
                    ->allowedValues(fn (int $value): bool => $value >= 1);

                $optionsResolver->define('per_page')
                    ->allowedTypes('int');
            }
        );

        return $this;
    }

    public function enableSorting(string $sort = 'regular_count'): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver) use ($sort): void {
                $optionsResolver->define('direction')
                    ->allowedTypes('string')
                    ->allowedValues('ASC', 'DESC');

                $optionsResolver->define('sort')
                    ->allowedTypes('string')
                    ->default($sort);
            }
        );

        return $this;
    }

    public function build(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();
        foreach ($this->configurators as $configurator) {
            $configurator($optionsResolver);
        }

        return $optionsResolver;
    }
}
