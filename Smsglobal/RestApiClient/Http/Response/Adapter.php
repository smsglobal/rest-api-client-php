<?php
namespace Smsglobal\RestApiClient\Http\Response;

use Smsglobal\RestApiClient\Http\HeaderBag;

/**
 * An interface for HTTP responses using different HTTP libraries
 *
 * @package Smsglobal\RestApiClient\Http\Response
 */
interface Adapter
{
    /**
     * Gets the body content
     *
     * @return string
     */
    public function getContent();

    /**
     * Gets the headers from the response
     *
     * @return HeaderBag
     */
    public function getHeaders();

    /**
     * Gets the status code
     *
     * @return int
     */
    public function getStatusCode();
}
