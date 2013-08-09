<?php
namespace Smsglobal\RestApiClient\Http\Request;

use Smsglobal\RestApiClient\Http\Response\Stream as Response;

/**
 * Makes a HTTP request using the http:// stream wrapper
 *
 * @package Smsglobal\RestApiClient\Http\Request
 */
class Stream implements Adapter
{
    /**
     * {@inheritdoc}
     */
    public function request(
        $url,
        $method = 'GET',
        array $headers = array(),
        $content = null
    ) {
        $streamHeaders = array();

        foreach ($headers as $header => $value) {
            $streamHeaders[] = sprintf('%s: %s', $header, $value);
        }

        $headers = implode("\r\n", $streamHeaders);

        $context = stream_context_create(
            array(
                'http' => array(
                    'method' => $method,
                    'header' => $headers,
                    'content' => $content,
                    // Disable following location because the REST API uses Location
                    // for the 201 Created response
                    'follow_location' => 0,
                    // Prevent an error from non 2xx or 3xx status codes
                    'ignore_errors' => true,
                ),
            )
        );

        return new Response(
            file_get_contents($url, null, $context),
            // Using this var may show an error in your IDE. It's actually set
            // by the above call to file_get_contents
            // http://php.net/manual/en/reserved.variables.httpresponseheader.php
            $http_response_header
        );
    }
}
