<?php
namespace Smsglobal\RestApiClient\Resource;

/**
 * A resource representing an SMSGlobal scheduled SMS
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class SmsScheduled extends Base
{
    /**
     * Date/time
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * Origin
     * @var string
     */
    protected $origin;

    /**
     * Destination
     * @var string
     */
    protected $destination;

    /**
     * Message
     * @var string
     */
    protected $message;

    /**
     * Sets the dateTime
     *
     * @param \DateTime $dateTime The date and time, in UTC, the SMS is
     * scheduled to be sent
     *
     * @return $this Provides a fluent interface
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Gets the dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
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
     * Sets the destination
     *
     * @param string $destination Destination mobile number. 4-15 digits
     *
     * @return $this Provides a fluent interface
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Gets the destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
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
