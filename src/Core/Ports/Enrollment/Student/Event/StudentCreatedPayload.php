<?php

declare(strict_types=1);

namespace App\Core\Ports\Enrollment\Student\Event;

use App\Core\Contract\Adapter\Event\EventPayload as EventPayloadContract;
use App\Core\Contract\Domain\Student;

final readonly class StudentCreatedPayload implements EventPayloadContract
{
    public function __construct(
        private Student $student
    ) {
    }

    public function serialize(): string
    {
        //...
    }
}
