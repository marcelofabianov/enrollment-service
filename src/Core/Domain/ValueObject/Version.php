<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Core\Contract\Domain\ValueObject\Version as VersionContract;
use App\Core\Domain\Exception\ValueObjectException;

final readonly class Version implements VersionContract
{
    const int MIN_VALUE = 1;

    private function __construct(private int $value)
    {
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function equals(VersionContract $other): bool
    {
        return $this->value === $other->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function increment(): VersionContract
    {
        return new self($this->value + 1);
    }

    public static function validate(int $value): bool
    {
        return $value >= self::MIN_VALUE;
    }

    /**
     * @throws ValueObjectException
     */
    public static function create(int|VersionContract|null $value): VersionContract
    {
        if ($value instanceof VersionContract) {
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

    public static function new(): VersionContract
    {
        return new self(self::MIN_VALUE);
    }
}
