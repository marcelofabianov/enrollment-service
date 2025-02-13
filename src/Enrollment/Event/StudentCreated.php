<?php

declare(strict_types=1);

namespace App\Enrollment\Event;

use App\Core\Contract\Adapter\Event\EventBody;
use App\Core\Contract\Adapter\Event\EventHeader;
use App\Core\Contract\Adapter\Event\EventMetadata;
use App\Core\Contract\Adapter\Event\EventPayload;
use App\Core\Ports\Enrollment\Student\Event\StudentCreated as StudentCreatedContract;
use App\Core\Ports\Enrollment\Student\Event\StudentCreatedPayload;
use App\Core\Ports\Enrollment\Student\Event\StudentTopicEnum;

final readonly class StudentCreated implements StudentCreatedContract
{
    private StudentTopicEnum $topic;

    public function __construct(
        private EventHeader $header,
        private EventBody $body,
        private EventMetadata $metadata,
    ) {
        $this->topic = StudentTopicEnum::STUDENT_CREATED;
    }

    public function serialize(): string
    {
        // TODO: Implement serialize() method.
    }

    public function setPayload(StudentCreatedPayload $payload): void
    {
        // TODO: Implement setPayload() method.
    }

    public function getPayload(): EventPayload
    {
        // TODO: Implement getPayload() method.
    }

    public function getTopic(): string
    {
        return $this->topic->value;
    }
}
