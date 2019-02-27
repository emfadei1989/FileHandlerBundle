<?php

namespace EFA\FileHandlerBundle\Controller;

use EFA\FileHandlerBundle\Service\ConnectionType\ConnectionFactory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EFA\FileHandlerBundle\Service\IFileService;
use Symfony\Component\HttpFoundation\Request;
use EFA\FileHandlerBundle\Validator\IMainFileValidator;
use EFA\FileHandlerBundle\FileRepository\IFileRepository;
use EFA\FileHandlerBundle\DTO\FileDTO;

class FileController extends Controller
{
    /**
     * @var IFileService
     */
    protected $fileService;

    /**
     * @var IMainFileValidator
     */
    private $validator;
    /**
     * @var ConnectionFactory
     */
    private $connectionFactory;


    public function __construct(IFileService $fileService, IMainFileValidator $validator, ConnectionFactory $connectionFactory )
    {
        $this->fileService = $fileService;
        $this->validator = $validator;
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @Route("/file/find/string")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function loadAction(Request $request): Response
    {
        $params = $request->query->all();
        $filePath = $params['file_path'] ?? null;
        $findString = $params['find_string'] ?? null;
        if (!$filePath) {
            throw new \Exception("Parameter 'file_path' not set");
        }
        if (!$findString) {
            throw new \Exception("Parameter 'find_string' not set");
        }
        $FileDTO = $this->connectionFactory->getConnectionType($filePath)->getFileInfo($filePath);

        $this->validator->validate($FileDTO);

        $results = $this->fileService->findSubStringInFile($FileDTO->getPath(), $findString);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'success' => true,
            'results' => $results,
        ]));

        return $response;
    }
}
