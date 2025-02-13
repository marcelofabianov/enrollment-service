<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain\ValueObject;

use DateTimeInterface;

interface InactivatedAt
{
    public function __toString(): string;

    public function getValue(): DateTimeInterface|null;

    public function toISO8601(): string|null;

    public function format(string $format = 'Y-m-d H:i:s'): string|null;

    public function isActive(): bool;

    public function isInactive(): bool;

    public function inactivate(): self;

    public function reactivate(): self;

    public static function validate(string|null|DateTimeInterface $value): bool;

    public static function create(self|DateTimeInterface|string|null $value = null): self;

    public static function default(): self;
}
