<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal MNP lookup
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class Lookup extends Base
{
    /**
     * Pending
     * @var int
     */
    const STATUS_PENDING = 0;

    /**
     * Success
     * @var int
     */
    const STATUS_SUCCESS = 1;

    /**
     * Unavailable
     * @var int
     */
    const STATUS_UNAVAILABLE = 2;

    /**
     * Invalid
     * @var int
     */
    const STATUS_INVALID = 3;

    /**
     * MSISDN
     * @var string
     */
    protected $msisdn;

    /**
     * Operator
     * @var string
     */
    protected $operator;

    /**
     * Whether the number is ported
     * @var bool
     */
    protected $isPorted;

    /**
     * The date/time of the request
     * @var \DateTime
     */
    protected $dateTimeRequested;

    /**
     * Status
     * @var int
     */
    protected $status;

    /**
     * Sets the MSISDN
     *
     * @param string $msisdn Mobile phone number including country and area
     * codes. 4 to 15 digits; no spaces or other formatting
     * @return $this Provides a fluent interface
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = (string) $msisdn;

        return $this;
    }

    /**
     * Gets the MSISDN
     *
     * @return string
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Gets the operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Gets whether the number was ported
     *
     * @return bool
     */
    public function isPorted()
    {
        return $this->isPorted;
    }

    /**
     * Gets the date/time of the request
     *
     * @return \DateTime
     */
    public function getDateTimeRequested()
    {
        return $this->dateTimeRequested;
    }

    /**
     * Gets the status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}
