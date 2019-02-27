<?php

namespace EFA\FileHandlerBundle\Service\ConnectionType;

class ConnectionFactory
{
    /**
     * @var string
     */
    private $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function getConnectionType(string $filePath): ConnectionType
    {
        if (false !== strpos($filePath, 'http://') || false !== strpos($filePath, 'https://')) {
            return new HttpConnectionType();
        } elseif (false !== strpos($filePath, 'ftp://')) {
            return new FtpConnectionType();
        } else {
            return new LocalConnectionType($this->rootPath);
        }
    }
}