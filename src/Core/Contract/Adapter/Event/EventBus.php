<?php

declare(strict_types=1);

namespace App\Core\Contract\Adapter\Event;

interface EventBus
{
    public function Publish(Event $event): void;

    public function Subscribe(string $eventName, callable $callback): void;
}
