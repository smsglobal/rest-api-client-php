<?php
namespace Smsglobal\RestApiClient;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function testVersion()
    {
        $this->assertEquals(1, Version::REST_API_VERSION);
    }
}
