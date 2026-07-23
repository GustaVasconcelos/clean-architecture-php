<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Cpf
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf) ?? '';

        if (!$this->isValid($cpf)) {
            throw new \DomainException('Invalid CPF');
        }

        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }

    private function isValid(string $cpf): bool
    {
        if (strlen($cpf) !== 11) {
            return false;
        }

        if ($this->hasAllDigitsEqual($cpf)) {
            return false;
        }

        $firstNineDigits = substr($cpf, 0, 9);
        $firstCheckDigit = $this->calculateCheckDigit($firstNineDigits);
        $secondCheckDigit = $this->calculateCheckDigit($firstNineDigits . $firstCheckDigit);

        $expectedCpf = $firstNineDigits . $firstCheckDigit . $secondCheckDigit;

        return $cpf === $expectedCpf;
    }

    private function hasAllDigitsEqual(string $cpf): bool
    {
        return preg_match('/^(\d)\1{10}$/', $cpf) === 1;
    }

    private function calculateCheckDigit(string $base): int
    {
        $sum = 0;
        $weight = strlen($base) + 1;

        for ($i = 0; $i < strlen($base); $i++) {
            $sum += (int) $base[$i] * ($weight - $i);
        }

        $remainder = ($sum * 10) % 11;

        return $remainder === 10 ? 0 : $remainder;
    }
}
