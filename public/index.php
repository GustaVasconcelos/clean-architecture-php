<?php

declare(strict_types=1);

use App\Domain\Entities\Registration;
use App\Domain\ValueObject\Cpf;
use App\Domain\ValueObject\Email;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$registration = (new Registration())
    ->setName('Gustavbo Vasconcelos')
    ->setEmail(new Email('gustavbo.vasconcelos@example.com'))
    ->setRegistrationNumber(new Cpf('529.982.247-25'))
    ->setBirthDate(new DateTimeImmutable('1995-03-15'))
    ->setRegistrationAt(new DateTimeImmutable('2026-07-23 15:43:00'));

echo $registration->getName() . PHP_EOL;
echo $registration->getEmail() . PHP_EOL;
echo $registration->getRegistrationNumber() . PHP_EOL;
echo $registration->getBirthDate()->format('Y-m-d') . PHP_EOL;
echo $registration->getRegistrationAt()->format('Y-m-d H:i:s') . PHP_EOL;
