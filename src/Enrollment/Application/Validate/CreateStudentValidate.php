<?php

declare(strict_types=1);

namespace App\Enrollment\Application\Validate;

use App\Core\Application\Validate;
use App\Core\Exception\ValidateException;
use App\Enrollment\Contract\CreateStudent\CreateStudentValidate as CreateStudentValidateContract;

final class CreateStudentValidate extends Validate implements CreateStudentValidateContract
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $identification
    ) {
    }

    public function success(): bool
    {
        if (empty($this->name) && is_string($this->name)) {
            $this->errors['name'] = 'validate.create_student.name.invalid';
        }

        if (empty($this->email) && is_string($this->email)) {
            $this->errors['email'] = 'validate.create_student.email.invalid';
        }

        if (empty($this->identification) && is_string($this->identification)) {
            $this->errors['identification'] = 'validate.create_student.identification.invalid';
        }

        return empty($this->errors);
    }

    public function throwException(): void
    {
        ValidateException::create($this->getErrors());
    }
}
