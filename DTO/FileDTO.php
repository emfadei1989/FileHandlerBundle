<?php

namespace EFA\FileHandlerBundle\DTO;

class FileDTO
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $mimeType;

    public function __construct(array $fileInfo)
    {
        $this->setPath($fileInfo['path'] ?? null);
        $this->setSize($fileInfo['size'] ?? null);
        $this->setMimeType($fileInfo['mimeType'] ?? null);
    }

    /**
     * @return string || null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return int || null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string || null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType(?string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }
}
