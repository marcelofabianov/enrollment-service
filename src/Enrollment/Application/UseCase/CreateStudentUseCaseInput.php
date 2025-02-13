<?php

declare(strict_types=1);

namespace App\Enrollment\Application\UseCase;

use App\Enrollment\Contract\CreateStudent\CreateStudentUseCaseInput as CreateStudentUseCaseInputContract;

final readonly class CreateStudentUseCaseInput implements CreateStudentUseCaseInputContract
{
    public function __construct(
        private string $name,
        private string $email,
        private string $identification
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }
}
