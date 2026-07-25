<?php

declare(strict_types=1);

namespace App\Infra\Adapters;

use App\Application\Contracts\ExportRegistration\ExportRegistrationPdfExporter;
use App\Domain\Entities\Registration;
use Spipu\Html2Pdf\Html2Pdf;

class Html2pdfAdapter implements ExportRegistrationPdfExporter
{
    public function generate(Registration $registration): string
    {
        $html = $this->buildHtml($registration);

        $html2pdf = new Html2Pdf('P', 'A4', 'pt');
        $html2pdf->writeHTML($html);

        return $html2pdf->output('', 'S');
    }

    private function buildHtml(Registration $registration): string
    {
        $name = htmlspecialchars($registration->getName(), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars((string) $registration->getEmail(), ENT_QUOTES, 'UTF-8');
        $registrationNumber = htmlspecialchars((string) $registration->getRegistrationNumber(), ENT_QUOTES, 'UTF-8');
        $birthDate = $registration->getBirthDate()->format('d/m/Y');
        $registrationAt = $registration->getRegistrationAt()->format('d/m/Y H:i:s');

        return <<<HTML
        <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <h1>Comprovante de Inscrição</h1>
            <p><strong>Nome:</strong> {$name}</p>
            <p><strong>E-mail:</strong> {$email}</p>
            <p><strong>CPF:</strong> {$registrationNumber}</p>
            <p><strong>Data de nascimento:</strong> {$birthDate}</p>
            <p><strong>Data da inscrição:</strong> {$registrationAt}</p>
        </page>
        HTML;
    }
}
