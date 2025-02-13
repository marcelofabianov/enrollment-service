<?php

declare(strict_types=1);

namespace App\Enrollment\Contract\CreateStudent;

interface CreateStudentUseCase
{
    public function execute(CreateStudentUseCaseInput $input): void;
}
