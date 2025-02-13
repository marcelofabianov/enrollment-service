<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Core\Contract\Domain\ValueObject\Id;
use App\Core\Exception\ValueObjectException;
use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class Uuid implements Id
{
    private function __construct(private string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Id $other): bool
    {
        return $this->value === $other->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function random(): Id
    {
        return new self((string) RamseyUuid::uuid4());
    }

    public static function validate(string $value): bool
    {
        if ($value === '') {
            return false;
        }

        return RamseyUuid::isValid($value);
    }

    /**
     * @throws ValueObjectException
     */
    public static function create(Id|string $value = null): Id
    {
        if ($value instanceof Id) {
            return $value;
        }

        if ($value === null) {
            return self::new();
        }

        if (! self::validate($value)) {
            throw ValueObjectException::invalidValue($value);
        }

        return new self($value);
    }

    public static function new(): Id
    {
        return new self((string) RamseyUuid::uuid4());
    }
}
