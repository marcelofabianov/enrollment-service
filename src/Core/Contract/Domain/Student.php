<?php

declare(strict_types=1);

namespace App\Core\Contract\Domain;

use App\Core\Contract\Domain\ValueObject\CreatedAt as CreatedAtContract;
use App\Core\Contract\Domain\ValueObject\Id;
use App\Core\Contract\Domain\ValueObject\InactivatedAt as InactivatedAtContract;
use App\Core\Contract\Domain\ValueObject\UpdatedAt as UpdatedAtContract;
use App\Core\Contract\Domain\ValueObject\Version as VersionContract;

interface Student
{
    public function getId(): Id;

    public function getName(): string;

    public function getEmail(): string;

    public function getIdentification(): string;

    public function getCreatedAt(): CreatedAtContract;

    public function getUpdatedAt(): UpdatedAtContract;

    public function update(): void;

    public function isActive(): bool;

    public function isInactive(): bool;

    public function inactivate(): void;

    public function reactivate(): void;

    public function incrementVersion(): void;

    public static function new(
        string $name,
        string $email,
        string $identification
    ): self;

    public static function from(
        Id $id,
        string $name,
        string $email,
        string $identification,
        CreatedAtContract $createdAt,
        UpdatedAtContract $updatedAt,
        InactivatedAtContract $inactivatedAt,
        VersionContract $version
    ): self;
}
