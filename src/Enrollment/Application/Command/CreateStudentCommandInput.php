<?php

declare(strict_types=1);

namespace App\Enrollment\Application\Command;

use App\Core\Ports\Enrollment\Student\Command\CreateStudentCommandInput as CreateStudentCommandInputContract;

final readonly class CreateStudentCommandInput implements CreateStudentCommandInputContract
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
