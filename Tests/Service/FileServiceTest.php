<?php

namespace EFA\FileHandlerBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use  EFA\FileHandlerBundle\Service\FileService;
use EFA\FileHandlerBundle\Service\FindStringService;

class FileServiceTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $fs_mock;

    /**
     * @var vfsStreamFile
     */
    private $file_mock;

    /**
     * @var FileService
     */
    private $suitObject;

    public function setUp()
    {
        $root = vfsStream::setup();
        $this->file_mock = vfsStream::newFile('large.txt')
            ->at($root);
        $this->suitObject = new FileService('', (new FindStringService()));
    }

    /**
     * @dataProvider findSubStringIFileProvider
     *
     * @param $content
     * @param $allItemsFindCount
     * @param $substr
     *
     * @throws \Exception
     */
    public function testFindSubStringInFile($content, $allItemsFindCount, $substr)
    {
        $this->file_mock->withContent($content);
        $result = $this->suitObject->findSubStringInFile($this->file_mock->url(), $substr);
        $this->assertEquals($allItemsFindCount, $result['allItemsFindCount']);
    }

    /**
     * @dataProvider getFileInfoFileProvider
     *
     * @param $content
     * @param $size
     * @param $mimeType
     *
     * @throws \Exception
     */
    public function testGetFileInfo($content, $size, $mimeType)
    {
        $this->file_mock->withContent($content);
        $results = $this->suitObject->getFileInfo($this->file_mock->url());
        $this->assertEquals($size, $results['size']);
        $this->assertEquals($mimeType, $results['mimeType']);
    }

    public function findSubStringIFileProvider()
    {
        return [
            [
                'Simple find text
                Simple text
                Simple text find
                ',
                2,
                'find',
            ],
            [
                'Simple find text
                Simple text
                Simple text find
                ',
                0,
                'empty',
            ],
        ];
    }

    public function getFileInfoFileProvider()
    {
        return [
            [
                'Simple find text
                Simple text
                Simple text find
                ',
                94,
                'text/plain',
            ],
            [
                'Simple find text
                Simple text
                Simple text find
                Simple find text
                Simple text
                Simple text find
                ',
                188,
                'text/plain',
            ],
        ];
    }
}
