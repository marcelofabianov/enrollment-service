<?php

declare(strict_types=1);

namespace App\Core\Domain\Exception;

use Exception;

final class ValueObjectException extends Exception
{
    public static function invalidValue(string|int $value): self
    {
        return new self("value_object.invalid_value $value");
    }
}
