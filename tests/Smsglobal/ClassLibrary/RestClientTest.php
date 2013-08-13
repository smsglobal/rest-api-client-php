<?php
namespace Smsglobal\RestApiClient;

use Smsglobal\RestApiClient\Http\HeaderBag;
use Smsglobal\RestApiClient\Http\Response\Adapter;

class AdapterStub implements Adapter
{
    protected $statusCode;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getContent()
    {
        return '{"error":"test"}';
    }

    public function getHeaders()
    {
        return new HeaderBag();
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}

class RestClientTest extends \PHPUnit_Framework_TestCase
{
    public function testHandleStatusCode()
    {
        $response = new AdapterStub();

        // Status code to expected exception. Null if there shouldn't be one
        $data = array(
            200 => null,
            201 => null,
            202 => null,
            204 => null,
            410 => null,
            400 => 'Smsglobal\\RestApiClient\\Exception\\InvalidDataException',
            401 => 'Smsglobal\\RestApiClient\\Exception\\AuthorizationException',
            404 => 'Smsglobal\\RestApiClient\\Exception\\ResourceNotFoundException',
            405 => 'Smsglobal\\RestApiClient\\Exception\\MethodNotAllowedException',
            500 => 'Smsglobal\\RestApiClient\\Exception\\ServiceException',
            502 => 'Smsglobal\\RestApiClient\\Exception\\ServiceException',
            503 => 'Smsglobal\\RestApiClient\\Exception\\ServiceException',
            504 => 'Smsglobal\\RestApiClient\\Exception\\ServiceException',
            418 => 'Exception',
        );

        $rest = new RestApiClient(new ApiKey('', ''));
        $method = new \ReflectionClass($rest);
        $method = $method->getMethod('handleStatusCode');
        $method->setAccessible(true);

        foreach ($data as $statusCode => $expectedException) {
            $response->setStatusCode($statusCode);

            try {
                $method->invoke($rest, $response);
            } catch (\Exception $ex) {
                if (null === $expectedException) {
                    $this->fail('Status code threw unexpected exception');
                }
                if ($expectedException === get_class($ex)) {
                    $this->addToAssertionCount(1);
                } else {
                    $this->fail('Status code threw incorrect exception: ' . get_class($ex) . ': ' . $ex->getMessage() . ' Status code: ' . $statusCode);
                }

                continue;
            }

            if (null === $expectedException) {
                $this->addToAssertionCount(1);
            }
        }
    }

    public function testGetTimeZone()
    {
        $rest = new RestApiClient(new ApiKey('', ''));
        $method = new \ReflectionClass($rest);
        $method = $method->getMethod('getTimeZone');
        $method->setAccessible(true);

        $timeZone = $method->invoke($rest);
        $this->assertInstanceOf('DateTimeZone', $timeZone);
        $this->assertSame($timeZone, $method->invoke($rest));
    }
}
