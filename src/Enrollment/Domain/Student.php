<?php

declare(strict_types=1);

namespace App\Enrollment\Domain;

use App\Core\Contract\Domain\Student as StudentContract;
use App\Core\Contract\Domain\ValueObject\Id;
use App\Core\Domain\ValueObject\Uuid;

final readonly class Student implements StudentContract
{
    private function __construct(
        private Id $id,
        private string $name,
        private string $email,
        private string $identification,
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }

    public static function new(string $name, string $email, string $identification): self
    {
        return new self(Uuid::new(), $name, $email, $identification);
    }

    public static function from(Id $id, string $name, string $email, string $identification): self
    {
        return new self($id, $name, $email, $identification);
    }
}
