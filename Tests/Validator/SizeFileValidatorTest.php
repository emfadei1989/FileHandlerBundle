<?php

namespace EFA\Tests\Validator;

use EFA\FileHandlerBundle\DTO\FileDTO;
use PHPUnit\Framework\TestCase;
use EFA\FileHandlerBundle\Validator\SizeFileValidator;

class SizeFileValidatorTest extends TestCase
{
    /**
     * @dataProvider FileFalseDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     * @expectedException \Exception
     */
    public function testValidateFail($sizeFile, $maxSize)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setSize($sizeFile);
        $sizeFileValidator = new SizeFileValidator($maxSize);
        $sizeFileValidator->validate($fileDTO);
    }

    /**
     * @dataProvider FileTrueDataProvider
     *
     * @param $sizeFile
     * @param $maxSize
     */
    public function testValidateTrue($sizeFile, $maxSize)
    {
        $fileDTO = new FileDTO([]);
        $fileDTO->setSize($sizeFile);
        $sizeFileValidator = new SizeFileValidator($maxSize);
        $this->assertTrue($sizeFileValidator->validate($fileDTO));
    }

    public function FileFalseDataProvider(): array
    {
        return [
            [1000, 500],
            [null, 500],
        ];
    }

    public function FileTrueDataProvider(): array
    {
        return [
            [500, 1000],
            [500, null],
        ];
    }
}
