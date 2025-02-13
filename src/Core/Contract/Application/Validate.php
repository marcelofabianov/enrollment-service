<?php

declare(strict_types=1);

namespace App\Core\Contract\Application;

interface Validate
{
    public function success(): bool;

    /**
     * @return array<string, string|array<string>>
     */
    public function getErrors(): array;

    public function throwException(): void;
}
