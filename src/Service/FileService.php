<?php

namespace EFA\FileHandlerBundle\Service;

class FileService implements IFileService
{
    /**
     * @var string
     */
    protected $rootPath;

    /**
     * @var \EFA\FileHandlerBundle\Service\IFindStringService
     */
    protected $findStringService;

    /**
     * FileService constructor.
     *
     * @param string             $rootPath
     * @param IFindStringService $findStringService
     */
    public function __construct(string $rootPath, IFindStringService $findStringService)
    {
        $this->rootPath = $rootPath;
        $this->findStringService = $findStringService;
    }

    /**
     * @param $filePath
     * @param string $substring
     *
     * @return array
     *
     * @throws \Exception
     */
    public function findSubStringInFile($filePath, string $substring): array
    {
        $results = [];

        $file = fopen($filePath, 'r');
        if (!$file) {
            throw new \Exception('file not found');
        }

        if ($file) {
            $currentRow = 0;
            $allItemsFindCount = 0;
            while (!feof($file)) {
                ++$currentRow;
                $buffer = fgets($file);
                $positions = $this->findStringService->findByRex($substring, $buffer);
                if ($positions) {
                    $results['items'][] = ['row' => $currentRow, 'positions' => $positions];
                    $allItemsFindCount += count($positions);
                }
            }
            $results['allItemsFindCount'] = $allItemsFindCount;

            fclose($file);
        }

        return $results;
    }

}
