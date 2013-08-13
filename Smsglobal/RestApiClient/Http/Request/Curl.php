<?php
namespace Smsglobal\RestApiClient\Http\Request;

use Smsglobal\RestApiClient\Http\Response\Curl as Response;

/**
 * Makes a request using the cURL library
 *
 * @package Smsglobal\RestApiClient\Http\Request
 */
class Curl implements Adapter
{
    /**
     * cURL handle. Static so that it can be reused to take advantage of HTTP
     * 1.1 keep-alive
     * @var resource
     */
    protected static $handle;

    /**
     * Closes the cURL handle if open
     */
    public static function closeHandle()
    {
        if (is_resource(self::$handle)) {
            curl_close(self::$handle);
        }

        self::$handle = null;
    }

    /**
     * Gets the cURL handle and creates a new one if not present
     *
     * @return resource
     */
    public static function getHandle()
    {
        if (null === self::$handle) {
            self::$handle = curl_init();
            curl_setopt(self::$handle, CURLOPT_RETURNTRANSFER, true);
        }

        return self::$handle;
    }

    /**
     * {@inheritdoc}
     */
    public function request(
        $url,
        $method = 'GET',
        array $headers = array(),
        $content = null
    ) {
        $curlHeaders = array();

        foreach ($headers as $header => $value) {
            $curlHeaders[] = sprintf('%s: %s', $header, $value);
        }

        $handle = self::getHandle();

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $curlHeaders);

        if (null !== $content) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, $content);
        }

        return new Response($handle);
    }
}
