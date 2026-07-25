<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

final class RegistrationNotFoundException extends DomainException
{
    public static function withRegistrationNumber(string $registrationNumber): self
    {
        return new self(sprintf('Registration not found for number: %s', $registrationNumber));
    }
}
