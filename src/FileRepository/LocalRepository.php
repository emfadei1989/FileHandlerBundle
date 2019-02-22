<?php

namespace EFA\FileHandlerBundle\FileRepository;

class LocalRepository implements IFileRepository
{
    /**
     * @var string
     */
    protected $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    public function load($filePath)
    {
        $localFilePath = $this->rootPath.$filePath;
        $file = fopen($localFilePath, 'r');
    }
}
