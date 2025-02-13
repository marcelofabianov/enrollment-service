<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Core\Contract\Domain\ValueObject\UpdatedAt as UpdatedAtContract;
use App\Core\Exception\ValueObjectException;
use DateMalformedStringException;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

final readonly class UpdatedAt implements UpdatedAtContract
{
    public function __construct(private DateTimeInterface $value)
    {
    }

    public function __toString(): string
    {
        return $this->toISO8601();
    }

    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }

    public function toISO8601(): string
    {
        return $this->value->format(DateTimeInterface::ATOM);
    }

    public function format(string $format = 'Y-m-d H:i:s'): string
    {
        return $this->value->format($format);
    }

    public static function random(): UpdatedAtContract
    {
        return new self(new DateTimeImmutable());
    }

    public static function now(): UpdatedAtContract
    {
        return new self(new DateTimeImmutable());
    }

    /**
     * @throws DateMalformedStringException|Exception
     */
    private static function convertToImmutable(string|DateTimeInterface $value): DateTimeImmutable
    {
        if ($value instanceof DateTimeImmutable) {
            return $value;
        }

        if ($value instanceof DateTime) {
            return DateTimeImmutable::createFromMutable($value);
        }

        return new DateTimeImmutable($value);
    }

    public static function validate(DateTimeInterface|string $value): bool
    {
        try {
            self::convertToImmutable($value);

            return true;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @throws DateMalformedStringException
     * @throws ValueObjectException
     */
    public static function create(UpdatedAtContract|DateTimeInterface|string|null $value = null): UpdatedAtContract
    {
        if ($value instanceof UpdatedAtContract) {
            return $value;
        }

        if ($value === null) {
            return self::now();
        }

        if (self::validate($value) === false) {
            throw ValueObjectException::invalidValue($value);
        }

        return new self(self::convertToImmutable($value));
    }

    public static function new(): UpdatedAtContract
    {
        return new self(new DateTimeImmutable());
    }
}
