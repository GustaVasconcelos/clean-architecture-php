<?php

declare(strict_types=1);

namespace App\Application\Usecases\ExportRegistration;

use App\Application\Usecases\ExportRegistration\OutputBoundary;
use App\Application\Usecases\ExportRegistration\InputBoundary;
use App\Domain\Repositories\LoadRegistrationRepository;
use App\Application\Contracts\ExportRegistration\ExportRegistrationPdfExporter;
use App\Application\Contracts\Storage;
use App\Domain\ValueObject\Cpf;

final class ExportRegistration
{
    private LoadRegistrationRepository $repository;
    private ExportRegistrationPdfExporter $pdfExport;
    private Storage $storage;

    public function __construct(
        LoadRegistrationRepository $repository,
        ExportRegistrationPdfExporter $pdfExport,
        Storage $storage
    ) {
        $this->repository = $repository;
        $this->pdfExport = $pdfExport;
        $this->storage = $storage;
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $cpf = new Cpf($input->getRegistrationNumber());

        $registration = $this->repository->loadByRegistrationNumber($cpf);

        $fileContent = $this->pdfExport->generate($registration);

        $this->storage->store($input->getFilename(), $input->getPath(), $fileContent);

        return new OutputBoundary($input->getPath() . DIRECTORY_SEPARATOR . $input->getFilename());
    }
}
