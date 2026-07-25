<?php

declare(strict_types=1);

namespace App\Infra\Http\Controllers;

use App\Infra\Http\Controllers\Presentation;
use App\Application\Usecases\ExportRegistration\ExportRegistration;
use App\Application\Usecases\ExportRegistration\InputBoundary;
use App\Application\Usecases\ExportRegistration\OutputBoundary;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ExportRegistrationController
{
    private Request $request;
    private Response $response;
    private ExportRegistration $usecase;
    private Presentation $presentation;
    
    public function __construct(Request $request, Response $response, ExportRegistration $exportRegistration, Presentation $presentation)
    {
        $this->request = $request;
        $this->response = $response;
        $this->usecase = $exportRegistration;
        $this->presentation = $presentation;
    }

    public function handle(): Response
    {
        $query = $this->request->getQueryParams();

        $inputBoundary = new InputBoundary(
            $query['registrationNumber'] ?? '',
            $query['filename'] ?? '',
            $query['path'] ?? '',
        );
        $outputBoundary = $this->usecase->handle($inputBoundary);

        $this->response->getBody()->write($this->presentation->output([
            'status' => 'success',
            'message' => 'Registration exported successfully',
            'data' => [
                'fullFileName' => $outputBoundary->getFullFileName(),
            ],
        ]));

        return $this->response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
