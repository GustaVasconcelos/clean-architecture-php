<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Cpf;
use DateTimeImmutable;
use DateTimeInterface;

final class Registration
{
    private string $name;
    private Email $email;
    private Cpf $registrationNumber;
    private DateTimeImmutable $birthDate;
    private DateTimeInterface $registrationAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRegistrationNumber(): Cpf
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(Cpf $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getBirthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(DateTimeImmutable $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getRegistrationAt(): DateTimeInterface
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(DateTimeInterface $registrationAt): self
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }
}
