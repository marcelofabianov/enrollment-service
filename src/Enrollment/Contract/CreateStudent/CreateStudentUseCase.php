<?php

declare(strict_types=1);

namespace App\Enrollment\Contract\CreateStudent;

use App\Core\Contract\Domain\Student;

interface CreateStudentUseCase
{
    public function execute(CreateStudentUseCaseInput $input): Student;
}
