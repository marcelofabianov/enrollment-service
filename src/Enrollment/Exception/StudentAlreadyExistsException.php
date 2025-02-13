<?php

declare(strict_types=1);

namespace App\Enrollment\Exception;

use App\Core\Exception\StatusCodeExceptionEnum;
use Exception;

final class StudentAlreadyExistsException extends Exception
{
    public function __construct(StatusCodeExceptionEnum $code = StatusCodeExceptionEnum::BAD_REQUEST)
    {
        parent::__construct('enrollment.student_already_exists', $code->value);
    }
}
