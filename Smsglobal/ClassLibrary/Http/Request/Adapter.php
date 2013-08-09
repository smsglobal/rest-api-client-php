<?php
namespace Smsglobal\ClassLibrary\Http\Request;

use Smsglobal\ClassLibrary\Http\Response;

/**
 * An interface for making requests using different HTTP libraries
 *
 * @package Smsglobal\ClassLibrary\Http\Request
 */
interface Adapter
{
    /**
     * Makes a HTTP request
     *
     * @param string $url     URL to request
     * @param string $method  HTTP method to use
     * @param array  $headers Headers to include
     * @param null   $content Body contents if applicable
     * @return Adapter
     */
    public function request(
        $url,
        $method = 'GET',
        array $headers = array(),
        $content = null
    );
}
