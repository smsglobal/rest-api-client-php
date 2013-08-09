<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal shared pool
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class SharedPool extends Base
{
    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Size
     * @var int
     */
    protected $size;

    /**
     * Sets the name
     *
     * @param string $name The name of this shared pool
     *
     * @return $this Provides a fluent interface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}
