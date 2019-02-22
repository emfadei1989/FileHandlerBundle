<?php

namespace EFA\FileHandlerBundle\Service;

interface IFileService
{
    /**
     * @param $filePath
     * @param string $substring
     *
     * @return array
     */
    public function findSubStringInFile($filePath, string $substring): array;

    /**
     * @param string $filePath
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getFileInfo(string $filePath): array;
}
