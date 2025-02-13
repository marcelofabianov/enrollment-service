<?php

declare(strict_types=1);

namespace App\Enrollment\Application\UseCase;

use App\Core\Contract\Domain\Student as StudentContract;
use App\Enrollment\Contract\CreateStudent\CreateStudentRepository;
use App\Enrollment\Contract\CreateStudent\CreateStudentUseCase as CreateStudentUseCaseContract;
use App\Enrollment\Contract\CreateStudent\CreateStudentUseCaseInput as CreateStudentUseCaseInputContract;
use App\Enrollment\Domain\Student;
use App\Enrollment\Exception\StudentAlreadyExistsException;

final readonly class CreateStudentUseCase implements CreateStudentUseCaseContract
{
    public function __construct(
        private CreateStudentRepository $repository
    ) {
    }

    /**
     * @throws StudentAlreadyExistsException
     */
    public function execute(CreateStudentUseCaseInputContract $input): StudentContract
    {
        if ($this->repository->exists($input->getIdentification())) {
            throw new StudentAlreadyExistsException();
        }

        $student = Student::new(
            $input->getName(),
            $input->getEmail(),
            $input->getIdentification(),
        );

        $this->repository->create($student);

        return $student;
    }
}
