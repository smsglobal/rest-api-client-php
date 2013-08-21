<?php
class PrerequisitesTest extends PHPUnit_Framework_TestCase
{
    /**
     * The minimum version of PHP required for this project
     * @var string
     */
    const PHP_VERSION_REQUIRED = '5.3.0';

    public function testPhpVersion()
    {
        $isRightVersion = version_compare(PHP_VERSION, self::PHP_VERSION_REQUIRED) >= 0;

        $this->assertTrue($isRightVersion, 'PHP 5.3+ is required');
    }

    public function testApc()
    {
        $this->assertTrue(function_exists('apc_fetch'), 'APC extension is not installed (not required, but good for performance)');
    }

    public function testSha256()
    {
        $this->assertContains('sha256', hash_algos(), 'sha256 hash algorithm is not supported');
    }

    public function testUtc()
    {
        $this->assertEquals('UTC', date_default_timezone_get(), 'Timezone must be UTC');
    }

    public function testCurl()
    {
        $this->assertTrue(function_exists('curl_version'), 'cURL is not enabled. Enable it or be sure to use the Stream request adapter instead');
    }

    public function testStream()
    {
        $this->assertContains('http', stream_get_wrappers(), 'The HTTP stream wrapper is not available. Enable it or be sure to use the cURL request adapter instead');
    }
}
