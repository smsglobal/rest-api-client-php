<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal incoming SMS
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class SmsIncoming extends Base
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
     * Message
     * @var string
     */
    protected $message;

    /**
     * Date/time
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * Whether the message is concatenated
     * @var bool
     */
    protected $isConcatenated;

    /**
     * Total parts
     * @var int
     */
    protected $totalParts;

    /**
     * Part number
     * @var int
     */
    protected $partNumber;

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
     * @return int
     */
    public function getDestination()
    {
        return $this->destination;
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
     * Gets the dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Gets the isConcatenated
     *
     * @return bool
     */
    public function isConcatenated()
    {
        return $this->isConcatenated;
    }

    /**
     * Gets the totalParts
     *
     * @return int
     */
    public function getTotalParts()
    {
        return $this->totalParts;
    }

    /**
     * Gets the partNumber
     *
     * @return int
     */
    public function getPartNumber()
    {
        return $this->partNumber;
    }
}
