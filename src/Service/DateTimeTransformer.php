<?php

declare(strict_types=1);

namespace Tuzex\Superfaktura\Service;

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

final class DateTimeTransformer
{
    public static function toString(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('Y-m-d H:i:s');
    }

    public static function toObject(string $dateTime): DateTimeInterface
    {
        $timeStamp = strtotime($dateTime);
        if (! $timeStamp) {
            throw new InvalidArgumentException(sprintf('Invalid date and time string "%s"', $dateTime));
        }

        return new DateTimeImmutable(sprintf('@%s', $timeStamp));
    }
}
