<?php
namespace Smsglobal\ClassLibrary\Http;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     */
    public function testPostWithoutContentType()
    {
        $request = new Request('http://httpbin.org/post');
        $request->post('{"data":true}');
    }
}
