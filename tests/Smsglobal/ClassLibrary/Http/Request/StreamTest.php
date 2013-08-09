<?php
namespace Smsglobal\ClassLibrary\Http\Request;

use Smsglobal\ClassLibrary\Http\Request;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    const ADAPTER = 'Smsglobal\\ClassLibrary\\Http\\Request\\Stream';

    public function testGet()
    {
        $request = new Request('http://httpbin.org/get', self::ADAPTER);
        $this->assertNotEquals('', $request->get()->getContent());
    }

    public function testPost()
    {
        $request = new Request('http://httpbin.org/post', self::ADAPTER);
        $request->headers->set('Content-Type', 'application/json');
        $content = $request->post('test')->getContent();
        $content = json_decode($content);
        $this->assertEquals('test', $content->data);
    }

    public function testDelete()
    {
        $request = new Request('http://httpbin.org/delete', self::ADAPTER);
        $this->assertNotEquals('', $request->delete()->getContent());
    }

    public function testPatch()
    {
        $request = new Request('http://httpbin.org/patch', self::ADAPTER);
        $request->headers->set('Content-Type', 'application/json');
        $content = $request->patch('test')->getContent();
        $content = json_decode($content);
        $this->assertEquals('test', $content->data);
    }

    public function testPut()
    {
        $request = new Request('http://httpbin.org/put', self::ADAPTER);
        $request->headers->set('Content-Type', 'application/json');
        $content = $request->put('test')->getContent();
        $content = json_decode($content);
        $this->assertEquals('test', $content->data);
    }

    public function testOptions()
    {
        $request = new Request('http://httpbin.org/', self::ADAPTER);
        $this->assertNotEquals('', $request->options()->getHeaders()->get('allow'));
    }

    public function testHead()
    {
        $request = new Request('http://httpbin.org/', self::ADAPTER);
        $this->assertNotEmpty($request->head()->getHeaders()->all());
    }
}
