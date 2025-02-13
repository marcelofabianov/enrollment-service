<?php

declare(strict_types=1);

namespace App\Core\Ports\Enrollment\Student\Event;

enum StudentTopicEnum: string
{
    case STUDENT_CREATED = 'student.created';
    case STUDENT_UPDATED = 'student.updated';
    case STUDENT_INACTIVATED = 'student.inactivated';
    case STUDENT_ACTIVATED = 'student.activated';
    case STUDENT_DELETED = 'student.deleted';
}
