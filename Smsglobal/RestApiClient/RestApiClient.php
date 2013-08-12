<?php
namespace Smsglobal\RestApiClient;

use Smsglobal\RestApiClient\Http\Request;
use Smsglobal\RestApiClient\Http\Response\Adapter;
use Smsglobal\RestApiClient\Resource\Base;

/**
 * Acts as an ORM of sorts for the REST API. Allows fetching, saving and
 * deleting resource objects
 *
 * @package Smsglobal\RestApiClient
 */
class RestApiClient
{
    /**
     * The default host for the API
     */
    const DEFAULT_HOST = 'api.smsglobal.com';

    /**
     * Time zone instance
     * @var \DateTimeZone
     */
    protected $timeZone;

    /**
     * Whether to use SSL for API calls
     * @var bool
     */
    protected $useSsl = true;

    /**
     * API key details
     * @var ApiKey
     */
    protected $apiKey;

    /**
     * Class name of request adapter to use
     * @var string
     */
    protected $requestAdapter;

    /**
     * Whether to allow caching objects
     * @var bool
     */
    protected $useCache = true;

    /**
     * Array of schema for each resource
     * @var array
     */
    protected $schema;

    /**
     * Cache of objects that have been previously retrieved
     * @var array
     */
    protected $resourceCache = array();

    /**
     * Constructor
     *
     * @param ApiKey $apiKey         API key instance
     * @param string $requestAdapter Request adapter class to use
     * @param bool   $useSsl         Whether to use SSL for API calls
     * @param string $host           API host name
     * @param bool   $allowCache     Whether to allow caching objects
     */
    public function __construct(
        ApiKey $apiKey,
        $requestAdapter = Request::DEFAULT_ADAPTER,
        $useSsl = true,
        $host = self::DEFAULT_HOST,
        $allowCache = true
    ) {
        $this->apiKey = $apiKey;
        $this->requestAdapter = $requestAdapter;
        $this->useSsl = (bool) $useSsl;
        $this->host = (string) $host;
        $this->useCache = (bool) $allowCache;
    }

    /**
     * Gets the schema for all resources
     *
     * @return array
     */
    protected function getSchema()
    {
        if (null === $this->schema) {
            $this->schema = include __DIR__ . '/Schema.php';
        }

        return $this->schema;
    }

    /**
     * Deletes the given resource
     *
     * @param Base $resource Resource instance
     * @return bool True if deletion was successful
     */
    public function delete(Base $resource)
    {
        $id = $resource->getId();

        if (null === $id) {
            // Resource is new, so there's nothing to delete
            return true;
        }

        $uri = $this->getResourceUri($resource, $id);
        $this->makeRequest($uri, 'DELETE');

        // If it gets here, the request was accepted/OK

        // Clear the ID so if it gets saved/deleted again, it will treated as a
        // new resource
        $resource->setId(null);

        if ($this->useCache) {
            // Remove it from the cache
            unset($this->resourceCache[$resource->getResourceName()][$id]);
        }

        return true;
    }

    /**
     * Gets a single resource of the given type and ID
     *
     * @param string $resource Resource name
     * @param int    $id       ID
     * @return Base
     */
    public function get($resource, $id)
    {
        $id = (int) $id;

        if ($this->useCache) {
            return $this->getResourceFromCache($resource, $id);
        } else {
            return $this->loadResourceData($resource, $id);
        }
    }

    /**
     * Gets a list of resources
     *
     * @param string $resource Resource name
     * @param int    $offset   Offset (used for pagination)
     * @param int    $limit    Limit (max results per page)
     * @param array  $filters  Optional filters to apply
     * @return object
     */
    public function getList(
        $resource,
        $offset = 0,
        $limit = PaginationData::DEFAULT_LIMIT,
        array $filters = array()
    ) {
        $uri = $this->getResourceUri($resource);

        $limit = (int) $limit;
        if ($limit !== PaginationData::DEFAULT_LIMIT) {
            $filters['limit'] = $limit;
        }

        $offset = (int) $offset;
        if (0 !== $offset) {
            $filters['offset'] = $offset;
        }

        if (!empty($filters)) {
            $uri = sprintf('%s?%s', $uri, http_build_query($filters));
        }

        $data = $this->makeRequest($uri);

        // Convert the objects to resource instances
        foreach ($data->objects as $i => $object) {
            $id = (int) $object->id;

            if ($this->useCache) {
                $object = $this->getResourceFromCache($resource, $id, $object);
            } else {
                $object = $this->instantiateResource($resource, $data);
            }

            $data->objects[$i] = $object;
        }

        // Handy utility for handling pagination
        $data->meta = new PaginationData($data->meta);

        return $data;
    }

    /**
     * Saves the resource. If it is new, it is created and the ID property will
     * be set to the new ID
     *
     * @param Base $resource Resource to save
     * @return Base $resource Saved resource
     */
    public function save(Base $resource)
    {
        $id = $resource->getId();
        $uri = $this->getResourceUri($resource, $id);

        $method = null === $id ? 'POST' : 'PATCH';

        $data = new \stdClass();

        $resourceName = $resource->getResourceName();

        $schema = $this->getSchema();

        foreach ($schema[$resourceName] as $name => $field) {
            $method = 'get' . ucfirst($name);
            $value = $resource->$method();

            if ('related' === $field->type) {
                if ($value instanceof Base) {
                    $value = $value->getId();
                }
            } elseif ('datetime' === $field->type) {
                /** @var \DateTime $value */
                $value = $value->format(\DateTime::ISO8601);
            }

            $data->name = $value;
        }

        // This will throw an exception if the request went bad
        /** @var Adapter $response */
        $response = $this->makeRequest($uri, $method, $data, true);

        // If the resource is new, the Location header will be set
        $id = $response->getHeaders()->get('Location');

        if (null !== $id) {
            // A new resource was created. Extract the ID from the Location
            // header (resource URI)
            // Remove trailing slash
            $id = substr($id, 0, -1);
            // Get everything after the last slash; cast to int
            $id = (int) substr($id, strrpos('/', $id) + 1, -1);

            $resource->setId($id);

            // Add it to the cache
            if ($this->useCache) {
                $this->addResourceToCache($resourceName, $id, $resource);
            }
        }

        // If it gets here, the request was accepted/OK
        return $resource;
    }

    /**
     * Gets the URI for a resource
     *
     * @param string   $resource Resource name
     * @param int|null $id       Optional ID number
     * @return string
     */
    protected function getResourceUri($resource, $id = null)
    {
        $uri = sprintf('/v%s/%s/', Version::REST_API_VERSION, $resource);

        if (null !== $id) {
            $uri = sprintf('%s%s/', $uri, $id);
        }

        return $uri;
    }

    /**
     * Checks the status code of a response and throws an exception if required
     *
     * @param Adapter $response Response instance
     *
     * @return void
     * @throws Exception\MethodNotAllowedException
     * @throws Exception\InvalidDataException
     * @throws Exception\ResourceNotFoundException
     * @throws Exception\AuthorizationException
     * @throws Exception\ServiceException
     * @throws \Exception
     */
    protected function handleStatusCode(Adapter $response)
    {
        $statusCode = $response->getStatusCode();

        switch ($statusCode) {
            // These codes are fine
            case 200:
                // OK
            case 201:
                // Created
            case 202:
                // Accepted
            case 204:
                // No Content
            case 410:
                // Gone
                break;

            // These codes are bad
            case 400:
                // Bad Request
                throw new Exception\InvalidDataException(
                    (array) json_decode($response->getContent()),
                    $statusCode
                );
            case 401:
                // Unauthorized
                $message = json_decode($response->getContent())->error;
                throw new Exception\AuthorizationException($message, $statusCode);
            case 404:
                // Not Found
                throw new Exception\ResourceNotFoundException('', $statusCode);
            case 405:
                // Method Not Allowed
                throw new Exception\MethodNotAllowedException('', $statusCode);

            // And these are also bad
            case 500:
                // Internal Server Error
            case 502:
                // Bad Gateway
            case 503:
                // Service Unavailable
            case 504:
                // Gateway Timeout
                throw new Exception\ServiceException('', $statusCode);
            default:
                throw new \Exception('Received unexpected response', $statusCode);
        }
    }

    /**
     * Makes a request to the API and returns the decoded response body ready
     * for use.
     *
     * Can also return the response object itself if $returnResponse is true
     *
     * @param string      $uri            URI to request (without hostname)
     * @param string      $method         HTTP method
     * @param null|string $content        Optional body content of the request,
     * not encoded
     * @param bool        $returnResponse Whether to return the response object
     * @return mixed
     */
    protected function makeRequest(
        $uri,
        $method = 'GET',
        $content = null,
        $returnResponse = false
    ) {
        $uri = sprintf(
            'http%s://%s%s',
            $this->useSsl ? 's' : '',
            $this->host,
            $uri
        );
        $request = new Request($uri);
        $request->headers->set('Accept', 'application/json');
        $this->setAuthorizationHeader($request, $method, $uri);

        if (null !== $content) {
            $request->headers->set('Content-Type', 'application/json');
            $content = json_encode($content);
        }

        $response = $request->setMethod($method)
            ->makeRequest($content);
        $this->handleStatusCode($response);

        if ($returnResponse) {
            return $response;
        }

        $content = json_decode($response->getContent());

        return $content;
    }

    /**
     * Sets the Authorization header on the given request
     *
     * @param Request $request    Request instance
     * @param string  $method     HTTP method
     * @param string  $requestUri Request URI
     * @return $this Provides a fluent interface
     */
    protected function setAuthorizationHeader(
        Request $request,
        $method,
        $requestUri
    ) {
        $header = $this->apiKey->getAuthorizationHeader(
            $method,
            $requestUri,
            $this->host,
            $this->useSsl ? 443 : 80
        );

        $request->headers->set('Authorization', $header);

        return $this;
    }

    /**
     * Checks if a resource is cached
     *
     * @param string $resource Resource name
     * @param int    $id       ID
     * @return bool
     */
    protected function isResourceCached($resource, $id)
    {
        if (!isset($this->resourceCache[$resource])) {
            $this->resourceCache[$resource] = array();
        }

        return isset($this->resourceCache[$resource][$id]);
    }

    /**
     * Gets a resource from the cache. Instantiates then caches one if not found
     *
     * @param string      $resource Resource name
     * @param int         $id       ID
     * @param object|null $data     Data to use for instantiation
     * @return Base
     */
    protected function getResourceFromCache($resource, $id, $data = null)
    {
        if (!$this->isResourceCached($resource, $id)) {
            if (null === $data) {
                $data = $this->loadResourceData($resource, $id);
            }

            $this->resourceCache[$resource][$id] = $this->instantiateResource(
                $resource,
                $data
            );
        }

        return $this->resourceCache[$resource][$id];
    }

    /**
     * Instantiate a resource of the given type using the given data
     *
     * @param string $resource Resource name
     * @param object $data     Data to use for the instance
     *
     * @return Base
     */
    protected function instantiateResource($resource, $data)
    {
        $class = sprintf('%s\\Resource\\%s', __NAMESPACE__, $resource);

        $schema = $this->getSchema();

        foreach ($schema[$resource] as $name => $field) {
            $data->name = $this->convertFieldValue(
                $data->name,
                $field->type,
                $name
            );
        }

        return new $class($data);
    }

    /**
     * Gets the time zone to use for instantiating resources with date fields
     *
     * @return \DateTimeZone
     */
    protected function getTimeZone()
    {
        if (null === $this->timeZone) {
            $this->timeZone = new \DateTimeZone('UTC');
        }

        return $this->timeZone;
    }

    /**
     * Convert a field's value to a suitable PHP value
     *
     * @param mixed  $value Value to convert
     * @param string $type  Field type
     * @param string $name  Field name (used for returning Proxy objects)
     *
     * @return mixed
     */
    protected function convertFieldValue($value, $type, $name)
    {
        switch ($type) {
            case 'boolean':
                $value = (bool) $value;
                break;
            case 'dateTime':
                $value = new \DateTime($value, $this->getTimeZone());
                break;
            case 'integer':
                $value = (int) $value;
                break;
            case 'float':
                $value = (float) $value;
                break;
            case 'related':
                $name = ucfirst($name);

                if (is_string($value)) {
                    $proxy = sprintf(
                        '%s\\Resource\\Proxy\\%sProxy',
                        __NAMESPACE__,
                        $name
                    );
                    $value = new $proxy($value, $this);
                } else {
                    // Assume an array/object representing the resource
                    $class = sprintf(
                        '%s\\Resource\\%s',
                        __NAMESPACE__,
                        $name
                    );
                    $value = new $class($value);
                }
                break;
            case 'string':
            default:
                $value = (string) $value;
        }

        return $value;
    }

    /**
     * Loads the data for a given resource
     *
     * @param string $resource Resource name
     * @param int    $id       ID
     * @return object
     */
    protected function loadResourceData($resource, $id)
    {
        $uri = $this->getResourceUri($resource, $id);
        $data = $this->makeRequest($uri);

        return $data;
    }

    /**
     * Adds a resource to the cache
     *
     * @param string $resourceName
     * @param int    $id
     * @param Base   $resource
     * @return $this Provides a fluent interface
     */
    protected function addResourceToCache($resourceName, $id, Base $resource)
    {
        if (!isset($this->resourceCache[$resourceName])) {
            $this->resourceCache[$resourceName] = array();
        }

        $this->resourceCache[$resourceName][$id] = $resource;

        return $this;
    }

    /**
     * Sets whether to cache resources.
     *
     * Disable to improve performance when batch processing, or when objects may
     * change outside of this request and you want to maintain freshness
     *
     * Enable to improve performance when there's a chance of objects being
     * fetched multiple times
     *
     * @param bool $useCache
     * @return $this Provides a fluent interface
     */
    public function setUseCache($useCache = true)
    {
        $this->useCache = (bool) $useCache;

        return $this;
    }

    /**
     * Gets whether to cache resources
     *
     * @return bool
     */
    public function useCache()
    {
        return $this->useCache;
    }
}
