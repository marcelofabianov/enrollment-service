<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain\ValueObject;

interface Version
{
    public function __toString(): string;

    public function equals(self $other): bool;

    public function getValue(): int;

    public function increment(): self;

    public static function validate(int $value): bool;

    public static function create(self|int|null $value): self;

    public static function new(): self;
}
