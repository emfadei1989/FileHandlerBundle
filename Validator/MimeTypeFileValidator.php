<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

class MimeTypeFileValidator extends AbstractFileValidator
{
    /**
     * @var string
     */
    private $mimeType;

    public function __construct(?string $mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @param FileDTO $fileDTO
     *
     * @throws \Exception
     */
    public function validate(FileDTO $fileDTO)
    {
        if (!$fileDTO->getMimeType()) {
            throw new \Exception('File mime-type undefined');
        }
        if ($this->mimeType) {
            $typeSet = array_map('trim', explode(',', $this->mimeType));
            if (!in_array($fileDTO->getMimeType(), $typeSet)) {
                throw new \Exception("File have incorrect mime-type - {$fileDTO->getMimeType()}. Available - ".implode(',', $typeSet));
            }
        }

        return parent::validate($fileDTO);
    }
}
