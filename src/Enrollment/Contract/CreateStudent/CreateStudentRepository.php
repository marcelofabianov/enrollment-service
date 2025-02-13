<?php

declare(strict_types=1);

namespace App\Enrollment\Contract\CreateStudent;

use App\Core\Contract\Domain\Student;

interface CreateStudentRepository
{
    public function exists(string $identification): bool;

    public function create(Student $student): void;
}
