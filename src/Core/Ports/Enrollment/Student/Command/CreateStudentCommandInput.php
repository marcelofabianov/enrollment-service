<?php

declare(strict_types=1);

namespace App\Core\Ports\Enrollment\Student\Command;

interface CreateStudentCommandInput
{
    public function getName(): string;

    public function getEmail(): string;

    public function getIdentification(): string;
}
