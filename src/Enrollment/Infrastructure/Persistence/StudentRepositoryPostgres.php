<?php

declare(strict_types=1);

namespace App\Enrollment\Infrastructure\Persistence;

use App\Core\Contract\Adapter\Database;
use App\Core\Contract\Domain\Student;
use App\Enrollment\Contract\StudentRepository as StudentRepositoryContract;

final readonly class StudentRepositoryPostgres implements StudentRepositoryContract
{
    public function __construct(
        private Database $database
    ) {
    }

    public function exists(string $identification): bool
    {
        //...

        return true;
    }

    public function create(Student $student): void
    {
        //...
    }
}
