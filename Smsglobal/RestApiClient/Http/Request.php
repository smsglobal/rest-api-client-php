<?php
namespace Smsglobal\RestApiClient\Http;

use Smsglobal\RestApiClient\Http\Response\Adapter;

/**
 * A class for dealing with HTTP requests and responses
 *
 * @package Smsglobal\RestApiClient\Http
 */
class Request
{
    const DEFAULT_ADAPTER = 'Smsglobal\\RestApiClient\\Http\\Request\\Curl';

    /**
     * Class name of the adapter to use
     * @var string
     */
    protected $adapter;

    /**
     * URL to request
     * @var string
     */
    protected $url;

    /**
     * Request method
     * @var string
     */
    protected $method = 'GET';

    /**
     * Request headers
     * @var HeaderBag
     */
    public $headers;

    /**
     * Constructor
     *
     * @param null|string $url     URL to request
     * @param string      $adapter Request adapter to use
     */
    public function __construct($url = null, $adapter = self::DEFAULT_ADAPTER)
    {
        $this->setUrl($url);
        $this->adapter = $adapter;
        $this->headers = new HeaderBag();
    }

    /**
     * Sets the URL to request
     *
     * @param string $url URL to request
     * @return $this Provides a fluent interface
     */
    public function setUrl($url)
    {
        $this->url = (string) $url;

        return $this;
    }

    /**
     * Gets the URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the HTTP request method
     *
     * @param string $method Request method
     * @return Request Provides a fluent interface
     */
    public function setMethod($method)
    {
        $this->method = (string) strtoupper($method);

        return $this;
    }

    /**
     * Gets the HTTP request method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Makes the request and returns a response adapter object
     *
     * @param null|string $body Data to send (for POST/PATCH/PUT requests)
     * @return Adapter
     * @throws \RuntimeException
     */
    public function makeRequest($body = null)
    {
        /** @var Request\Adapter $adapter */
        $adapter = new $this->adapter();

        if (null !== $body && !$this->headers->has('content-type')) {
            throw new \RuntimeException('Attempting to send data without setting a Content-Type header');
        }

        $headers = array();

        foreach ($this->headers->all() as $name => $values) {
            $name = implode('-', array_map('ucfirst', explode('-', $name)));
            $headers[$name] = $values[0];
        }

        $response = $adapter->request(
            $this->url,
            $this->method,
            $headers,
            $body
        );

        return $response;
    }

    /**
     * Performs a GET request
     *
     * @return Adapter
     */
    public function get()
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest();
    }

    /**
     * Performs a POST request
     *
     * @param null|string $data Data to send
     * @return Adapter
     */
    public function post($data = null)
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest($data);
    }

    /**
     * Performs a DELETE request
     *
     * @return Adapter
     */
    public function delete()
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest();
    }

    /**
     * Performs a PATCH request
     *
     * @param null|string $data Data to send
     * @return Adapter
     */
    public function patch($data = null)
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest($data);
    }

    /**
     * Performs a PUT request
     *
     * @param null|string $data Data to send
     * @return Adapter
     */
    public function put($data = null)
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest($data);
    }

    /**
     * Performs an OPTIONS request
     *
     * @return Adapter
     */
    public function options()
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest();
    }

    /**
     * Performs a HEAD request
     *
     * @return Adapter
     */
    public function head()
    {
        return $this->setMethod(__FUNCTION__)
            ->makeRequest();
    }
}
