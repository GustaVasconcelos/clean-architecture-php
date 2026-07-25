<?php

declare(strict_types=1);

namespace App\Application\Usecases\ExportRegistration;

final class InputBoundary
{
    private string $registrationNumber;
    private string $filename;
    private string $path;

    public function __construct(string $registrationNumber, string $filename, string $path)
    {
        $this->registrationNumber = $registrationNumber;
        $this->filename = $filename;
        $this->path = $path;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
