<?php

declare(strict_types=1);

namespace App\Core\Ports\Enrollment\Student\Command;

interface CreateStudentCommand
{
    public function execute(CreateStudentCommandInput $input): void;
}
