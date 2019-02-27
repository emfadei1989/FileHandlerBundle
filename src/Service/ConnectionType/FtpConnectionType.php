<?php

namespace EFA\FileHandlerBundle\Service\ConnectionType;

use EFA\FileHandlerBundle\DTO\FileDTO;

class FtpConnectionType implements ConnectionType
{

    /**
     * @param string $filePath
     *
     * @return FileDTO
     *
     * @throws \Exception
     */
    public function getFileInfo(string $filePath): FileDTO
    {
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

        $fileDto = new FileDTO();
        $fileDto->setPath($filePath);
        $fileDto->setSize($info['download_content_length']);
        $fileDto->setMimeType(substr($info['content_type'], 0, strpos($info['content_type'], ';')));

        return $fileDto;
    }
}