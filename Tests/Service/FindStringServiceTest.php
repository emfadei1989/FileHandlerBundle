<?php

namespace EFA\FileHandlerBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use EFA\FileHandlerBundle\Service\FindStringService;

class FindStringServiceTest extends TestCase
{
    /**
     * @var FindStringService;
     */
    protected $suitObject;

    public function setUp()
    {
        $this->suitObject = new FindStringService();
    }

    /**
     * @dataProvider findByRexFileProvider
     *
     * @param $pattern
     * @param $string
     * @param $countFound
     */
    public function testFindByRex($pattern, $string, $countFound)
    {
        $this->assertEquals($countFound, count($this->suitObject->findByRex($pattern, $string)));
    }

    /**
     * @dataProvider findByPosFileProvider
     *
     * @param $substr
     * @param $string
     * @param $countFound
     */
    public function testFindByPos($substr, $string, $countFound)
    {
        $this->assertEquals($countFound, count($this->suitObject->findByPos($substr, $string)));
    }

    public function findByRexFileProvider()
    {
        return [
            [
                'text',
                'Simple find text
                Simple text
                Simple text find
                ',
                3,
            ],
            [
                'empty',
                'Simple find text
                Simple text
                Simple text find
                ',
                0,
            ],
        ];
    }

    public function findByPosFileProvider()
    {
        return [
            [
                'text',
                'Simple find text
                Simple text
                Simple text find
                ',
                3,
            ],
            [
                'empty',
                'Simple find text
                Simple text
                Simple text find
                ',
                0,
            ],
        ];
    }
}
