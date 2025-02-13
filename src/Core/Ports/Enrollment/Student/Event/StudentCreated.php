<?php

declare(strict_types=1);

namespace App\Core\Ports\Enrollment\Student\Event;

use App\Core\Contract\Adapter\Event\Event as EventContract;
use App\Core\Contract\Adapter\Event\EventPayload;

interface StudentCreated extends EventContract
{
    public function setPayload(StudentCreatedPayload $payload): void;

    public function getPayload(): EventPayload;
}
