<?php

declare(strict_types=1);

namespace App\Core\Application;

class Validate
{
    /**
     * @var array<string, string|array<string>>
     */
    protected array $errors = [];

    /**
     * @return array<string, string|array<string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
