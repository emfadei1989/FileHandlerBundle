<?php

namespace EFA\Tests\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;
use PHPUnit\Framework\TestCase;
use EFA\FileHandlerBundle\Validator\MainFileValidator;

class MainFileValidatorTest extends TestCase
{
    /**
     * @dataProvider FileFalseDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     * @expectedException \Exception
     */
    public function testValidateFail($mimeTypeFile, $mimeTypes, $sizeFile, $maxSize)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setMimeType($mimeTypeFile);
        $fileDTO->setSize($sizeFile);
        $mainFileValidator = new MainFileValidator(['maxSize' => $maxSize, 'mime-type' => $mimeTypes]);
        $mainFileValidator->validate($fileDTO);
    }

    /**
     * @dataProvider FileTrueDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     */
    public function testValidateTrue($mimeTypeFile, $mimeTypes, $sizeFile, $maxSize)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setMimeType($mimeTypeFile);
        $fileDTO->setSize($sizeFile);
        $mainFileValidator = new MainFileValidator(['maxSize' => $maxSize, 'mime-type' => $mimeTypeFile]);
        $this->assertTrue($mainFileValidator->validate($fileDTO));
    }

    public function FileFalseDataProvider(): array
    {
        return [
            ['text/plain', 'text/html,text/css', 1000, 500],
            [null, 'text/html,text/css', null, 500],
        ];
    }

    public function FileTrueDataProvider(): array
    {
        return [
            ['text/plain', 'text/plain,text/css', 500, 1000],
            ['text/plain', null, 500, null],
        ];
    }
}
