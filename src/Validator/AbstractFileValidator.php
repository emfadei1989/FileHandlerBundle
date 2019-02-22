<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

abstract class AbstractFileValidator implements IFileValidator
{
    /**
     * @var IFileValidator
     */
    private $nextValidator;

    public function setNext(IFileValidator $validator): IFileValidator
    {
        $this->nextValidator = $validator;

        return $validator;
    }

    public function validate(FileDTO $fileDTO)
    {
        if ($this->nextValidator) {
            return $this->nextValidator->validate($fileDTO);
        }

        return true;
    }
}
