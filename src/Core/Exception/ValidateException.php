<?php

declare(strict_types=1);

namespace App\Core\Exception;

use Exception;

final class ValidateException extends Exception
{
    /**
     * @param array<string, string|array<string>> $errors
     * @param StatusCodeExceptionEnum             $code
     *
     * @return ValidateException
     * @throws \JsonException
     */
    public static function create(
        array $errors,
        StatusCodeExceptionEnum $code = StatusCodeExceptionEnum::UNPROCESSABLE_ENTITY
    ): self {
        return new self(json_encode($errors, JSON_THROW_ON_ERROR), $code->value);
    }
}
