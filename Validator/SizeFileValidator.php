<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

class SizeFileValidator extends AbstractFileValidator
{
    /**
     * @var int
     */
    private $maxSize;

    public function __construct(?int $maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @param FileDTO $fileDTO
     *
     * @throws \Exception
     */
    public function validate(FileDTO $fileDTO)
    {
        if (!$fileDTO->getSize()) {
            throw new \Exception('File size undefined');
        }
        if ($this->maxSize) {
            if ($fileDTO->getSize() > $this->maxSize) {
                throw new \Exception("File is too large - {$fileDTO->getSize()} bytes. Max size $this->maxSize");
            }
        }

        return parent::validate($fileDTO);
    }
}
