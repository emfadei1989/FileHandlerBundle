<?php

namespace EFA\FileHandlerBundle\Service\ConnectionType;

use EFA\FileHandlerBundle\DTO\FileDTO;

interface ConnectionType
{
    public function getFileInfo(string $filePath): FileDTO;
}