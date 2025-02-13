<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Core\Contract\Domain\ValueObject\InactivatedAt as InactivatedAtContract;
use App\Core\Exception\ValueObjectException;
use DateMalformedStringException;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

final readonly class InactivatedAt implements InactivatedAtContract
{
    private function __construct(private DateTimeInterface|null $value)
    {
    }

    public function __toString(): string
    {
        return $this->value ? $this->toISO8601() : 'active';
    }

    public function getValue(): DateTimeInterface|null
    {
        return $this->value;
    }

    public function toISO8601(): string|null
    {
        return $this->value?->format(DateTimeInterface::ATOM);
    }

    public function format(string $format = 'Y-m-d H:i:s'): string|null
    {
        return $this->value?->format($format);
    }

    public function isActive(): bool
    {
        return $this->value === null;
    }

    public function isInactive(): bool
    {
        return $this->value !== null;
    }

    public function inactivate(): InactivatedAtContract
    {
        return new self(new DateTimeImmutable());
    }

    public function reactivate(): InactivatedAtContract
    {
        return new self(null);
    }

    /**
     * @throws DateMalformedStringException
     * @throws Exception
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

    public static function validate(DateTimeInterface|string|null $value): bool
    {
        if ($value === null) {
            return true;
        }

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
    public static function create(InactivatedAtContract|DateTimeInterface|string|null $value = null): InactivatedAtContract
    {
        if ($value instanceof InactivatedAtContract) {
            return $value;
        }

        if ($value === null) {
            return self::default();
        }

        if (self::validate($value) === false) {
            throw ValueObjectException::invalidValue($value);
        }

        return new self(self::convertToImmutable($value));
    }

    public static function default(): InactivatedAtContract
    {
        return new self(null);
    }
}
