<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

class MainFileValidator implements IMainFileValidator
{
    /**
     * @var array
     */
    protected $validateParams;

    public function __construct(array $validateParams)
    {
        $this->validateParams = $validateParams;
    }

    /**
     * @param FileDTO $FileDTO
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validate(FileDTO $FileDTO)
    {
        $sizeValidator = new SizeFileValidator($this->validateParams['maxSize'] ?? null);
        $mimeTypeValidator = new MimeTypeFileValidator($this->validateParams['mime-type'] ?? null);
        $sizeValidator->setNext($mimeTypeValidator);

        $sizeValidator->validate($FileDTO);

        return true;
    }
}
