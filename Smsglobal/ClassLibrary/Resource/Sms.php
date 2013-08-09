<?php
namespace Smsglobal\RestApiClient\Resource;

use Smsglobal\RestApiClient\RestApiClient;

/**
 * A resource representing an SMSGlobal SMS
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class Sms extends Base
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
     * Date/time created
     * @var \DateTime
     */
    protected $dateTimeCreated;

    /**
     * Campaign
     * @var Campaign|null
     */
    protected $campaign;

    /**
     * Shared pool
     * @var null|SharedPool
     */
    protected $sharedPool;

    /**
     * Sets the origin
     *
     * @param null|string $origin Where the SMS appears to come from. 4-11
     * characters A-Za-z0-9 if alphanumeric; 4-15 digits if numeric (if set, set
     * sharedPool to null)
     * @return $this Provides a fluent interface
     */
    public function setOrigin($origin)
    {
        if (null !== $origin) {
            $this->sharedPool = null;
            $origin = (string) $origin;
        }

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
     * Sets the message
     *
     * @param string $message The SMS message. If longer than 160 characters
     * (GSM) or 70 characters (Unicode), splits into multiple SMS
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
     * Gets the dateTimeCreated
     *
     * @return \DateTime
     */
    public function getDateTimeCreated()
    {
        return $this->dateTimeCreated;
    }

    /**
     * Sets the campaign
     *
     * @param Campaign|null $campaign The campaign the message is associated with (optional)
     * @return $this Provides a fluent interface
     */
    public function setCampaign($campaign)
    {
        if (null !== $campaign && !($campaign instanceof Campaign)) {
            $campaign = (int) $campaign;
        }

        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Gets the campaign
     *
     * @return Campaign|null
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Sets the sharedPool
     *
     * @param null|SharedPool $sharedPool The shared pool to use (if set, set origin to null)
     *
     * @return $this Provides a fluent interface
     */
    public function setSharedPool($sharedPool)
    {
        if (null !== $sharedPool) {
            $this->origin = null;

            if (!($sharedPool instanceof SharedPool)) {
                $sharedPool = (int) $sharedPool;
            }
        }

        $this->sharedPool = $sharedPool;

        return $this;
    }

    /**
     * Gets the sharedPool
     *
     * @return null|SharedPool
     */
    public function getSharedPool()
    {
        return $this->sharedPool;
    }

    /**
     * Shortcut that sends an SMS
     *
     * @param RestApiClient $manager     Manager instance to send with
     * @param string          $origin      Origin
     * @param string          $destination Destination
     * @param string          $message     Message
     * @return Sms New SMS object
     */
    public static function send(RestApiClient $manager, $origin, $destination, $message)
    {
        $sms = new Sms();
        $sms->setOrigin($origin)
            ->setDestination($destination)
            ->setMessage($message);

        $manager->save($sms);

        return $sms;
    }
}
