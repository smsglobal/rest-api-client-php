<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal SMS template
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class Template extends Base
{
    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Origin
     * @var string
     */
    protected $origin;

    /**
     * Message
     * @var string
     */
    protected $message;

    /**
     * Sets the name
     *
     * @param string $name The name of this template. Used when displaying
     * templates in a list etc. Max length of 100 characters
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
     * Sets the origin
     *
     * @param string $origin Where the SMS appears to come from. 4-11 characters
     * A-Za-z0-9 if alphanumeric; 4-15 digits if numeric
     *
     * @return $this Provides a fluent interface
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Gets the origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the message
     *
     * @param string $message The SMS message. If longer than 160 characters
     * (GSM) or 70 characters (Unicode), splits into multiple SMS
     *
     * @return $this Provides a fluent interface
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Gets the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
