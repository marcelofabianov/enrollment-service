<?php

declare(strict_types=1);

namespace App\Core\Contract\Adapter\Event;

interface EventBody
{
    public function setPayload(array $payload): void;
}
