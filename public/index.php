<?php

declare(strict_types=1);

use App\Application\Usecases\ExportRegistration\ExportRegistration;
use App\Infra\Adapters\Html2pdfAdapter;
use App\Infra\Adapters\LocalStorageAdapter;
use App\Infra\Http\Controllers\ExportRegistrationController;
use App\Infra\Persistence\PdoConnectionFactory;
use App\Infra\Repositories\PdoLoadRegistrationRepository;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use App\Infra\Presentation\ExportRegistrationPresenter;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$pdo = PdoConnectionFactory::makeFromEnv();
$loadRegistrationRepository = new PdoLoadRegistrationRepository($pdo);
$pdfExport = new Html2pdfAdapter();
$storage = new LocalStorageAdapter();

$exportRegistration = new ExportRegistration($loadRegistrationRepository, $pdfExport, $storage);

$request = (new ServerRequest('GET', 'http://localhost:8000/'))
    ->withQueryParams([
        'registrationNumber' => '529.982.247-25',
        'filename' => 'xpto.pdf',
        'path' => dirname(__DIR__) . '/storage',
    ]);
$response = new Response();
$presentation = new ExportRegistrationPresenter();
$exportRegistrationController = new ExportRegistrationController($request, $response, $exportRegistration, $presentation);
echo $exportRegistrationController->handle();
