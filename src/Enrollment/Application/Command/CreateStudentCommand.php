<?php

declare(strict_types=1);

namespace App\Enrollment\Application\Command;

use App\Core\Contract\Adapter\Event\EventBus as EventBusContract;
use App\Core\Contract\Adapter\Logger as LoggerContract;
use App\Core\Ports\Enrollment\Student\Command\CreateStudentCommand as CreateStudentCommandPort;
use App\Core\Ports\Enrollment\Student\Command\CreateStudentCommandInput;
use App\Enrollment\Application\UseCase\CreateStudentUseCaseInput;
use App\Enrollment\Contract\CreateStudent\CreateStudentUseCase;
use App\Enrollment\Contract\CreateStudent\CreateStudentValidate;

final readonly class CreateStudentCommand implements CreateStudentCommandPort
{
    public function __construct(
        private EventBusContract $eventBus,
        private LoggerContract $logger,
        private CreateStudentValidate $validate,
        private CreateStudentUseCase $useCase
    ) {
    }

    public function execute(CreateStudentCommandInput $input): void
    {
        if (! $this->validate->success()) {
            $this->validate->throwException();
        }

        $this->useCase->execute(new CreateStudentUseCaseInput(
            $input->getName(),
            $input->getEmail(),
            $input->getIdentification(),
        ));

        $this->eventBus();

        $this->logger->info('Student created');
    }

    private function eventBus(): void
    {
        //...
    }
}
