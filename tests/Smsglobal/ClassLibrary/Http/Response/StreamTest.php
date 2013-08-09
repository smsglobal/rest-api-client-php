<?php
namespace Smsglobal\ClassLibrary\Http;

use Smsglobal\ClassLibrary\Http\Request;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    const ADAPTER = 'Smsglobal\\ClassLibrary\\Http\\Request\\Stream';

    public function testStatusCode()
    {
        $request = new Request('http://httpbin.org/status/418', self::ADAPTER);
        $this->assertEquals(418, $request->get()->getStatusCode());
    }
}
