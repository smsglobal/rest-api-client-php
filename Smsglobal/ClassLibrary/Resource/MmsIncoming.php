<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal incoming MMS
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class MmsIncoming extends Base
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
     * Date/time received
     * @var \DateTime
     */
    protected $dateTimeReceived;

    /**
     * Attachments
     * @var array
     */
    protected $attachments;

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
     * Gets the destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
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
     * Gets the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Gets the dateTimeReceived
     *
     * @return \DateTime
     */
    public function getDateTimeReceived()
    {
        return $this->dateTimeReceived;
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
}
