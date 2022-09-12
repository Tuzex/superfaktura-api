<?php

declare(strict_types=1);

namespace Codea\Superfaktura\Api;

final class Collection extends Resource
{
    public function isEmpty(): bool
    {
        return ! $this->hasData();
    }

    public function filter(Filter ...$filters): self
    {
        foreach ($filters as $filter) {
            $this->addOptions($filter->getCriteria());
        }

        return $this;
    }

    public function paginate(int $page, int $perPage): self
    {
        $this->addOptions([
            'page' => $page > 0 ? $page : 1,
            'per_page' => $perPage > 0 ? $perPage : 1,
        ]);

        return $this;
    }

    public function sort(string $direction, string $attribute = 'regular_count'): self
    {
        $this->addOptions([
            'direction' => $direction,
            'sort' => $attribute,
        ]);

        return $this;
    }

    public function verbose(): self
    {
        $this->addOptions([
            'listinfo' => 1,
        ]);

        return $this;
    }
}
