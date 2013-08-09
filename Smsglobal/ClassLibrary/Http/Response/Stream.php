<?php
namespace Smsglobal\ClassLibrary\Http\Response;

use Smsglobal\ClassLibrary\Http\HeaderBag;

/**
 * Processes a response from the http:// stream wrapper
 *
 * @package Smsglobal\ClassLibrary\Http\Response
 */
class Stream implements Adapter
{
    /**
     * Response body
     * @var string
     */
    protected $content;

    /**
     * Headers from the request
     * @var HeaderBag
     */
    protected $headers;

    /**
     * Status code
     * @var int
     */
    protected $statusCode;

    /**
     * Constructor
     *
     * @param string $content Response body
     * @param array  $headers Headers array
     */
    public function __construct($content, array $headers)
    {
        $this->content = $content;

        // Shift the first element off, which is the HTTP/1.x header. We can get
        // the status code from there
        $this->statusCode = array_shift($headers);

        // The remaining items in the array are the actual headers we want
        $this->headers = $headers;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        if (!($this->headers instanceof HeaderBag)) {
            foreach ($this->headers as $i => $line) {
                list($name, $value) = explode(': ', $line, 2);

                // Replace the number indexed item with an associative index
                unset($this->headers[$i]);
                $this->headers[$name] = $value;
            }

            $this->headers = new HeaderBag($this->headers);
        }

        return $this->headers;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        if (is_string($this->statusCode)) {
            // Get the status code from the first line of the response
            // e.g. HTTP/1.1 200 OK  ->  200
            $this->statusCode = (int) substr($this->statusCode, 9, 3);
        }

        return $this->statusCode;
    }
}
