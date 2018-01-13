<?php

namespace Tests\Unit\app\Controllers;

use App\Controllers\SiteController;
use PHPUnit\Framework\TestCase;

class SiteControllerTest extends TestCase
{
    public function testConstruct()
    {
        /** @var \Twig_Environment $twig */
        $twig = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->setMethods()
            ->getMock();

        $controller = new SiteControllerMock($twig);
        $this->assertInstanceOf(\Twig_Environment::class, $controller->twig);
    }

    /**
     * @dataProvider indexDataProvider
     *
     * @param $renderResult
     */
    public function testIndex($renderResult)
    {
        /** @var \Twig_Environment $twig */
        $twig = $this->getMockBuilder(\Twig_Environment::class)
            ->disableOriginalConstructor()
            ->setMethods(['render'])
            ->getMock();

        $twig->expects($this->once())
            ->method('render')
            ->willReturn($renderResult);

        $controller = new SiteControllerMock($twig);
        $actualResult = $controller->index();

        $this->assertSame($renderResult, $actualResult);
    }

    public function indexDataProvider()
    {
        return [
            ['test1'], ['test2'], ['test3'],
        ];
    }
}

class SiteControllerMock extends SiteController
{
    public $twig;
}