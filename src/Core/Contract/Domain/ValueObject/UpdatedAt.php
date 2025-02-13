<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain\ValueObject;

use DateTimeInterface;

interface UpdatedAt
{
    public function __toString(): string;

    public function getValue(): DateTimeInterface;

    public function toISO8601(): string;

    public function format(string $format = 'Y-m-d H:i:s'): string;

    public static function random(): self;

    public static function now(): self;

    public static function validate(string|DateTimeInterface $value): bool;

    public static function create(self|DateTimeInterface|string|null $value = null): self;

    public static function new(): self;
}
