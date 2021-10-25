<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

use Closure;
use Symfony\Component\OptionsResolver\Options;
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

    public function addPagination(int $page = 1, int $perPage = 50): self
    {
        $this->configurators[] = function (OptionsResolver $optionsResolver) use ($page, $perPage): void {
            $optionsResolver->define('page')
                ->required()
                ->allowedTypes('int')
                ->normalize(fn (Options $options, int $value): int => $value > 0 ? $value : 1)
                ->default($page)
                ->info('Page number');

            $optionsResolver->define('per_page')
                ->required()
                ->allowedTypes('int')
                ->normalize(fn (Options $options, int $value): int => $value > 0 ? $value : 50)
                ->default($perPage)
                ->info('Number of results per page');
        };

        return $this;
    }

    public function addSorting(string $direction = 'DESC', string $attribute = 'regular_count'): self
    {
        $this->configurators[] = function (OptionsResolver $optionsResolver) use ($direction, $attribute): void {
            $optionsResolver->define('direction')
                ->required()
                ->allowedTypes('string')
                ->allowedValues('ASC', 'DESC')
                ->default($direction)
                ->info('Sorting direction');

            $optionsResolver->define('sort')
                ->allowedTypes('string')
                ->default($attribute)
                ->info('Sorting attribute');
        };

        return $this;
    }

    public function addListInfo(): self
    {
        $this->configurators[] = function (OptionsResolver $optionsResolver): void {
            $optionsResolver->define('listinfo')
                ->allowedTypes('int')
                ->allowedValues(0, 1)
                ->info('Show meta information for results (1=yes)');
        };

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
