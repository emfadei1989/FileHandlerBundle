<?php

namespace EFA\FileHandlerBundle\Service\ConnectionType;

use EFA\FileHandlerBundle\DTO\FileDTO;

class LocalConnectionType implements ConnectionType
{

    /**
     * @var string
     */
    private $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @param string $filePath
     * @return FileDTO
     */
    public function getFileInfo(string $filePath): FileDTO
    {
        $localPath = $this->rootPath.$filePath;
        $fileDto = new FileDTO();
        $fileDto->setPath($localPath);
        $fileDto->setSize(filesize($localPath));
        $fileDto->setMimeType(mime_content_type($localPath));

        return $fileDto;
    }

}