<?php

declare(strict_types=1);

namespace App\Core\Contract\Adapter\Event;

interface EventPayload
{
    public function serialize(): string;
}
