<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Core\Contract\Domain\ValueObject\CreatedAt as CreatedAtContract;
use App\Core\Domain\Exception\ValueObjectException;
use DateMalformedStringException;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

final readonly class CreatedAt implements CreatedAtContract
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

    public static function random(): CreatedAtContract
    {
        return new self(new DateTimeImmutable());
    }

    public static function now(): CreatedAtContract
    {
        return new self(new DateTimeImmutable());
    }

    /**
     * @throws DateMalformedStringException
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
    public static function create(CreatedAtContract|DateTimeInterface|string|null $value = null): CreatedAtContract
    {
        if ($value instanceof CreatedAtContract) {
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

    public static function new(): CreatedAtContract
    {
        return new self(new DateTimeImmutable());
    }
}
