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

    /**
     * @param string $filePath
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getFileInfo(string $filePath): array
    {
        $results = [];

        if (false !== strpos($filePath, 'http://') || false !== strpos($filePath, 'https://')) {
            $connection = 'http';
        } elseif (false !== strpos($filePath, 'ftp://')) {
            $connection = 'ftp';
        } else {
            $connection = 'local';
        }

        switch ($connection) {
            case 'local':
                $localPath = $this->rootPath.$filePath;
                $results['path'] = $localPath;
                $results['size'] = filesize($localPath);
                $results['mimeType'] = mime_content_type($localPath);

                break;
            case 'http':
                $ch = curl_init($filePath);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_FTPLISTONLY, 1);
                curl_exec($ch);

                $info = curl_getinfo($ch);
                if (200 !== $info['http_code'] || (300 < $info['http_code'] && 308 < $info['http_code'])) {
                    throw new \Exception('File not available or not found');
                }
                $results['path'] = $filePath;
                $results['size'] = $info['download_content_length'];
                $results['mimeType'] = substr($info['content_type'], 0, strpos($info['content_type'], ';'));

                break;
            case 'ftp':
                $ch = curl_init($filePath);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_exec($ch);
                $info = curl_getinfo($ch);
                if ($info['download_content_length'] < 0) {
                    throw new \Exception('File not available or not found');
                }
                $results['path'] = $filePath;
                $results['size'] = $info['download_content_length'];
                $results['mimeType'] = substr($info['content_type'], 0, strpos($info['content_type'], ';'));
                break;
            default:
                throw new \Exception('File path incorrect');
        }

        return $results;
    }
}
