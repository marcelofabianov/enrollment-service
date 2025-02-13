<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain;

use App\Core\Contract\Domain\ValueObject\Id;

interface Student
{
    public function getId(): Id;

    public function getName(): string;

    public function getEmail(): string;

    public function getIdentification(): string;

    public static function new(string $name, string $email, string $identification): self;

    public static function from(Id $id, string $name, string $email, string $identification): self;
}
