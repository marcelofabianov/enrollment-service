<?php

declare(strict_types=1);

namespace App\Enrollment\Domain;

use App\Core\Contract\Domain\Student as StudentContract;
use App\Core\Contract\Domain\ValueObject\CreatedAt as CreatedAtContract;
use App\Core\Contract\Domain\ValueObject\Id;
use App\Core\Contract\Domain\ValueObject\InactivatedAt as InactivatedAtContract;
use App\Core\Contract\Domain\ValueObject\UpdatedAt as UpdatedAtContract;
use App\Core\Contract\Domain\ValueObject\Version as VersionContract;
use App\Core\Domain\ValueObject\CreatedAt;
use App\Core\Domain\ValueObject\InactivatedAt;
use App\Core\Domain\ValueObject\UpdatedAt;
use App\Core\Domain\ValueObject\Uuid;
use App\Core\Domain\ValueObject\Version;

final class Student implements StudentContract
{
    private function __construct(
        private readonly Id $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $identification,
        private readonly CreatedAtContract $createdAt,
        private UpdatedAtContract $updatedAt,
        private InactivatedAtContract $inactivatedAt,
        private VersionContract $version,
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

    public function getCreatedAt(): CreatedAtContract
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAtContract
    {
        return $this->updatedAt;
    }

    public function getVersion(): VersionContract
    {
        return $this->version;
    }

    public function update(): void
    {
        $this->updatedAt = UpdatedAt::now();
    }

    public function isActive(): bool
    {
        return $this->inactivatedAt->isActive();
    }

    public function isInactive(): bool
    {
        return $this->inactivatedAt->isInactive();
    }

    public function inactivate(): void
    {
        $this->inactivatedAt = $this->inactivatedAt->inactivate();
    }

    public function reactivate(): void
    {
        $this->inactivatedAt = $this->inactivatedAt->reactivate();
    }

    public function incrementVersion(): void
    {
        $this->version = $this->version->increment();
    }

    public static function new(
        string $name,
        string $email,
        string $identification
    ): self
    {
        return new self(
            Uuid::new(),
            $name,
            $email,
            $identification,
            CreatedAt::new(),
            UpdatedAt::new(),
            InactivatedAt::default(),
            Version::new(),
        );
    }

    public static function from(
        Id $id,
        string $name,
        string $email,
        string $identification,
        CreatedAtContract $createdAt,
        UpdatedAtContract $updatedAt,
        InactivatedAtContract $inactivatedAt,
        VersionContract $version,
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $identification,
            $createdAt,
            $updatedAt,
            $inactivatedAt,
            $version,
        );
    }
}
