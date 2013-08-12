<?php
namespace Smsglobal\RestApiClient\Resource;

/**
 * A resource representing an SMSGlobal campaign
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class Campaign extends Base
{
    /**
     * Group
     * @var Group
     */
    protected $group;

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
     * Date/time created
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * Whether the campaign has been sent
     * @var bool
     */
    protected $isSent;

    /**
     * Date/time scheduled
     * @var \DateTime|null
     */
    protected $dateTimeScheduled;

    /**
     * Message
     * @var string
     */
    protected $message;

    /**
     * Whether to stagger
     * @var bool
     */
    protected $useStagger;

    /**
     * Stagger batch size
     * @var int
     */
    protected $staggerBatchSize;

    /**
     * Stagger gap
     * @var int
     */
    protected $staggerGap;

    /**
     * Stagger start time
     * @var string
     */
    protected $staggerStartTime;

    /**
     * Stagger end time
     * @var string
     */
    protected $staggerEndTime;

    /**
     * Custom ID
     * @var string
     */
    protected $customId;

    /**
     * Sets the custom ID
     *
     * @param string $customId
     * @return $this Provides a fluent interface
     */
    public function setCustomId($customId)
    {
        $this->customId = (string) $customId;

        return $this;
    }

    /**
     * Gets the custom ID
     *
     * @return mixed
     */
    public function getCustomId()
    {
        return $this->customId;
    }
    /**
     * Gets the date/time created
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets the scheduled date/time. Null to send immediately
     *
     * @param \DateTime $dateTimeScheduled
     * @return $this Provides a fluent interface
     */
    public function setDateTimeScheduled(\DateTime $dateTimeScheduled)
    {
        $this->dateTimeScheduled = $dateTimeScheduled;

        return $this;
    }

    /**
     * Gets the date/time scheduled
     *
     * @return \DateTime|null
     */
    public function getDateTimeScheduled()
    {
        return $this->dateTimeScheduled;
    }

    /**
     * Sets the group to send to
     *
     * @param Group|int $group Group to send to
     * @return $this Provides a fluent interface
     */
    public function setGroup($group)
    {
        if (!($group instanceof Group)) {
            $group = (int) $group;
        }

        $this->group = $group;

        return $this;
    }

    /**
     * Gets the group to send to
     *
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Whether the campaign has been sent yet
     *
     * @return bool
     */
    public function isSent()
    {
        return $this->isSent;
    }

    /**
     * Sets the message
     *
     * @param string $message Message
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
     * Sets the name
     *
     * @param string $name Name to uniquely identify the campaign. Must be less than 100 characters long
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
     * Sets the origin
     *
     * @param string $origin Origin
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
     * Sets the stagger batch size
     *
     * @param int $staggerBatchSize Size of the stagger batches
     * @return $this Provides a fluent interface
     */
    public function setStaggerBatchSize($staggerBatchSize)
    {
        $this->staggerBatchSize = (int) $staggerBatchSize;

        return $this;
    }

    /**
     * Gets the stagger batch size
     *
     * @return int
     */
    public function getStaggerBatchSize()
    {
        return $this->staggerBatchSize;
    }

    /**
     * Gets the stagger end time
     *
     * @param string $staggerEndTime
     * @return $this Provides a fluent interface
     */
    public function setStaggerEndTime($staggerEndTime)
    {
        $this->staggerEndTime = (string) $staggerEndTime;

        return $this;
    }

    /**
     * Gets the stagger end time
     *
     * @return string
     */
    public function getStaggerEndTime()
    {
        return $this->staggerEndTime;
    }

    /**
     * Sets the stagger gap
     *
     * @param int $staggerGap Gap between stagger batches, in minutes
     * @return $this Provides a fluent interface
     */
    public function setStaggerGap($staggerGap)
    {
        $this->staggerGap = (int) $staggerGap;

        return $this;
    }

    /**
     * Gets the stagger gap
     *
     * @return int
     */
    public function getStaggerGap()
    {
        return $this->staggerGap;
    }

    /**
     * Sets the stagger start time
     *
     * @param string $staggerStartTime Stagger start time as a string hh:mm
     * @return $this Provides a fluent interface
     */
    public function setStaggerStartTime($staggerStartTime)
    {
        $this->staggerStartTime = (string) $staggerStartTime;

        return $this;
    }

    /**
     * Gets the stagger start time
     *
     * @return string
     */
    public function getStaggerStartTime()
    {
        return $this->staggerStartTime;
    }

    /**
     * Sets whether to stagger the send
     *
     * @param boolean $useStagger Whether to stagger
     * @return $this Provides a fluent interface
     */
    public function setUseStagger($useStagger = true)
    {
        $this->useStagger = (bool) $useStagger;

        return $this;
    }

    /**
     * Gets whether to stagger the send
     *
     * @return boolean
     */
    public function useStagger()
    {
        return $this->useStagger;
    }
}
