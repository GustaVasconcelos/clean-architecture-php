<?php

declare(strict_types=1);

namespace App\Application\Contracts\ExportRegistration;

use App\Domain\Entities\Registration;

interface ExportRegistrationPdfExporter
{
    public function generate(Registration $registration): string;
}