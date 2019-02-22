<?php

namespace EFA\FileHandlerBundle\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;

interface IMainFileValidator
{
    /**
     * @param FileDTO $FileDTO
     */
    public function validate(FileDTO $FileDTO);
}
