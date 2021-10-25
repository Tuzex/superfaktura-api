<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Api;

final class Collection extends Resource
{
    public function isEmpty(): bool
    {
        return ! $this->hasData();
    }

    public function filter(Criteria ...$criterias): self
    {
        foreach ($criterias as $criteria) {
            $this->addOptions($criteria->getOptions());
        }

        return $this;
    }

    public function paginate(int $page, int $perPage): self
    {
        $this->addOptions([
            'page' => $page,
            'per_page' => $perPage,
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
