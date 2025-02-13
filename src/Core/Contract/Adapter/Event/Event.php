<?php

declare(strict_types=1);

namespace App\Core\Contract\Adapter\Event;

interface Event
{
    public function __construct(
        EventHeader $header,
        EventBody $body,
        EventMetadata $metadata
    );

    public function serialize(): string;

    public function getTopic(): string;
}
