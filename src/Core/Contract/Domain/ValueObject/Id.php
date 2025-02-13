<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain\ValueObject;

/**
 * Interface Id
 *
 *
 * @property-read string $value
 */
interface Id
{
    public function __toString(): string;

    public function equals(self $other): bool;

    public static function random(): self;

    public function getValue(): string;

    public static function validate(string $value): bool;

    public static function create(self|string|null $value = null): self;

    public static function new(): self;
}
