<?php
namespace Smsglobal\ClassLibrary\Http\Response;

use Smsglobal\ClassLibrary\Http\HeaderBag;

/**
 * An interface for HTTP responses using different HTTP libraries
 *
 * @package Smsglobal\ClassLibrary\Http\Response
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
