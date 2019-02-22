<?php

namespace EFA\Tests\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;
use PHPUnit\Framework\TestCase;
use EFA\FileHandlerBundle\Validator\MimeTypeFileValidator;

class MimeTypeValidatorTest extends TestCase
{
    /**
     * @dataProvider FileFalseDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     * @expectedException \Exception
     */
    public function testValidateFail($mimeTypeFile, $mimeTypes)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setMimeType($mimeTypeFile);
        $mimeTypeFileValidator = new MimeTypeFileValidator($mimeTypes);
        $mimeTypeFileValidator->validate($fileDTO);
    }

    /**
     * @dataProvider FileTrueDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     */
    public function testValidateTrue($mimeTypeFile, $mimeTypes)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setMimeType($mimeTypeFile);
        $mimeTypeFileValidator = new MimeTypeFileValidator($mimeTypes);
        $this->assertTrue($mimeTypeFileValidator->validate($fileDTO));
    }

    public function FileFalseDataProvider(): array
    {
        return [
            ['text/plain', 'text/html,text/css'],
            [null, 'text/html,text/css'],
        ];
    }

    public function FileTrueDataProvider(): array
    {
        return [
            ['text/plain', 'text/plain,text/css'],
            ['text/plain', null],
        ];
    }
}
