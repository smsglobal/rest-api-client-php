<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal contact group
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class Group extends Base
{
    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Keyword
     * @var string
     */
    protected $keyword;

    /**
     * Default origin
     * @var string
     */
    protected $defaultOrigin;

    /**
     * Sets the name
     *
     * @param string $name Group name. Max length of 100 characters
     * @return $this Provides a fluent interface
     */
    public function setName($name)
    {
        $this->name = (string) $name;

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
     * Sets the keyword
     *
     * @param string $keyword Email to SMS keyword. Must be unique between your
     * groups
     * @return $this Provides a fluent interface
     */
    public function setKeyword($keyword)
    {
        $this->keyword = (string) $keyword;

        return $this;
    }

    /**
     * Gets the keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Sets the default origin
     *
     * @param string $defaultOrigin The default SMS origin for this group. 4-11
     * characters for alphanumeric or 4-15 digits for numeric
     * @return $this Provides a fluent interface
     */
    public function setDefaultOrigin($defaultOrigin)
    {
        $this->defaultOrigin = (string) $defaultOrigin;

        return $this;
    }

    /**
     * Gets the default origin
     *
     * @return string
     */
    public function getDefaultOrigin()
    {
        return $this->defaultOrigin;
    }
}
