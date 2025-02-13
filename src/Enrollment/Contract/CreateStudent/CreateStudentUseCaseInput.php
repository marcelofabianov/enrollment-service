<?php

declare(strict_types=1);

namespace App\Enrollment\Contract\CreateStudent;

interface CreateStudentUseCaseInput
{
    public function getName(): string;

    public function getEmail(): string;

    public function getIdentification(): string;
}
