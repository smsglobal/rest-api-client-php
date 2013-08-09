<?php
namespace Smsglobal\ClassLibrary\Resource;

use Smsglobal\ClassLibrary\Version;

/**
 * Abstract base class for all resources
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
abstract class Base
{
    /**
     * ID number. Null if the resource is new or has been deleted
     * @var int
     */
    protected $id;

    /**
     * Resource URI
     * @var string
     */
    protected $resourceUri;

    /**
     * Resource name for use by the API (dash-separated version of class name)
     * @var string
     */
    protected $resourceName;

    /**
     * Constructor
     *
     * @param array|null|object $options Pre-populate the object with data
     */
    public function __construct($options = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
    }

    /**
     * Gets a string representation of the resource: its ID
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * Gets the resource name
     * @return string
     */
    public function getResourceName()
    {
        if (null === $this->resourceName) {
            $parent = get_parent_class($this);
            if (__CLASS__ === $parent) {
                $this->resourceName = get_class($this);
            } else {
                $this->resourceName = $parent;
            }

            $slashPos = strrpos($this->resourceName, '\\');

            if (false !== $slashPos) {
                $this->resourceName = substr($this->resourceName, $slashPos + 1);
            }

            $this->resourceName = lcfirst($this->resourceName);
            $this->resourceName = preg_replace(
                '/([A-Z])/',
                '-$1',
                $this->resourceName
            );
            $this->resourceName = strtolower($this->resourceName);
        }

        return $this->resourceName;
    }

    /**
     * Sets the ID. It should only be set during instantiation. Do not use this
     * in your own code
     *
     * @param int|null $id ID
     * @return $this Provides a fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the ID
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the resource URI. It should only be set during instantiation. Do not
     * use this in your own code
     *
     * @param $resourceUri
     * @return $this
     */
    protected function setResourceUri($resourceUri)
    {
        $this->resourceUri = (string) $resourceUri;

        return $this;
    }

    /**
     * Gets the resource URI
     *
     * @return string
     * @throws Exception\NotYetSavedException
     */
    public function getResourceUri()
    {
        if (null === $this->id) {
            throw new Exception\NotYetSavedException();
        }

        if (null === $this->resourceUri) {
            $this->resourceUri = sprintf(
                '/v%s/%s/%s/',
                Version::REST_API_VERSION,
                $this->getResourceName(),
                $this->id
            );
        }

        return $this->resourceUri;
    }

    /**
     * Sets the properties of the object from an array or object
     *
     * @param array|object $options Options to populate with
     * @return $this Provides a fluent interface
     */
    public function setOptions($options)
    {
        if (is_object($options) || is_array($options)) {
            foreach ($options as $option => $value) {
                $method = sprintf('set%s', ucfirst($option));

                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }

        return $this;
    }
}
