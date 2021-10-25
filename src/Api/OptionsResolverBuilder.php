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

    public function addPagination(): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver): void {
                $optionsResolver->define('page')
                    ->allowedTypes('int')
                    ->allowedValues(fn (int $value): bool => $value >= 1)
                    ->info('Page number');

                $optionsResolver->define('per_page')
                    ->allowedTypes('int')
                    ->info('Number of results per page');
            }
        );

        return $this;
    }

    public function addSorting(string $attribute = 'regular_count'): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver) use ($attribute): void {
                $optionsResolver->define('direction')
                    ->allowedTypes('string')
                    ->allowedValues('ASC', 'DESC')
                    ->info('Sorting direction');

                $optionsResolver->define('sort')
                    ->allowedTypes('string')
                    ->default($attribute)
                    ->info('Sorting attribute');
            }
        );

        return $this;
    }

    public function addListInfo(): self
    {
        $this->setCustom(
            function (OptionsResolver $optionsResolver): void {
                $optionsResolver->define('listinfo')
                    ->allowedTypes('int')
                    ->allowedValues(0, 1)
                    ->info('Show meta information for results (1=yes)');
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
