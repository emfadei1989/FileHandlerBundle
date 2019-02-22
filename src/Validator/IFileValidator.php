<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

interface IFileValidator
{
    public function setNext(IFileValidator $validator): IFileValidator;

    public function validate(FileDTO $fileDTO);
}
