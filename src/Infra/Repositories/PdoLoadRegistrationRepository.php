<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Domain\Entities\Registration;
use App\Domain\Exceptions\RegistrationNotFoundException;
use App\Domain\Repositories\LoadRegistrationRepository;
use App\Domain\ValueObject\Cpf;
use App\Domain\ValueObject\Email;
use DateTimeImmutable;
use PDO;

final class PdoLoadRegistrationRepository implements LoadRegistrationRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function loadByRegistrationNumber(Cpf $registrationNumber): Registration
    {
        $statement = $this->pdo->prepare(
            'SELECT name, email, registration_number, birth_date, registration_at
             FROM registrations
             WHERE registration_number = :registration_number
             LIMIT 1'
        );

        $statement->execute([
            'registration_number' => (string) $registrationNumber,
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            throw RegistrationNotFoundException::withRegistrationNumber((string) $registrationNumber);
        }

        return (new Registration())
            ->setName($row['name'])
            ->setEmail(new Email($row['email']))
            ->setRegistrationNumber(new Cpf($row['registration_number']))
            ->setBirthDate(new DateTimeImmutable($row['birth_date']))
            ->setRegistrationAt(new DateTimeImmutable($row['registration_at']));
    }
}
