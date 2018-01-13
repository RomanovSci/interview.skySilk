<?php

namespace Tests\Unit\app\Controllers;

use App\Controllers\BaseController;

class BaseControllerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider unsuccessDataProvider
     *
     * @param $message
     */
    public function testUnsuccess($message)
    {
        $controller = new BaseControllerMock();
        $actualResult = $controller->unsuccess($message);

        $this->assertSame(json_encode([
            'success' => false,
            'message' => $message,
        ]), $actualResult);
    }

    public function unsuccessDataProvider()
    {
        return [
            ['test1'], ['test2'], ['test3'], [false], [null],
        ];
    }
}

class BaseControllerMock extends BaseController
{
    public function unsuccess($message = '')
    {
        return parent::unsuccess($message);
    }
}