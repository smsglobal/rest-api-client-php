<?php
namespace Smsglobal\RestApiClient\Resource;

use Smsglobal\RestApiClient\RestApiClient;

/**
 * A resource representing an SMSGlobal MMS
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class Mms extends Base
{
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
     * Subject
     * @var string
     */
    protected $subject;

    /**
     * Message
     * @var string
     */
    protected $message;

    /**
     * Date/time sent
     * @var \DateTime
     */
    protected $dateTimeSent;

    /**
     * Status
     * @var string
     */
    protected $status;

    /**
     * Date/time of status update
     * @var \DateTime
     */
    protected $dateTimeStatusUpdate;

    /**
     * Attachments
     * @var array
     */
    protected $attachments;

    /**
     * Sets the origin
     *
     * @param string $origin Where the MMS appears to come from. Must be a
     * dedicated number, otherwise it will be overridden with a shared pool
     * number
     *
     * @return $this Provides a fluent interface
     */
    public function setOrigin($origin)
    {
        $this->origin = (string) $origin;

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
        $this->destination = (string) $destination;

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
     * Sets the subject
     *
     * @param string $subject The subject line of the message
     *
     * @return $this Provides a fluent interface
     */
    public function setSubject($subject)
    {
        $this->subject = (string) $subject;

        return $this;
    }

    /**
     * Gets the subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets the message
     *
     * @param string $message The contents of the MMS message
     *
     * @return $this Provides a fluent interface
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;

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

    /**
     * Gets the dateTimeSent
     *
     * @return \DateTime
     */
    public function getDateTimeSent()
    {
        return $this->dateTimeSent;
    }

    /**
     * Gets the status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets the dateTimeStatusUpdate
     *
     * @return \DateTime
     */
    public function getDateTimeStatusUpdate()
    {
        return $this->dateTimeStatusUpdate;
    }

    /**
     * Gets the attachments
     *
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Shortcut that sends an SMS
     *
     * @param RestApiClient $rest REST API client instance to send with
     * @return $this Provides a fluent interface
     */
    public function send(RestApiClient $rest)
    {
        return $rest->save($this);
    }
}
