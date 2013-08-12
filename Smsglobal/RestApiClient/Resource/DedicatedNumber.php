<?php
namespace Smsglobal\RestApiClient\Resource;

/**
 * A resource representing an SMSGlobal dedicated number
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class DedicatedNumber extends Base
{
    /**
     * Disabled
     * @var int
     */
    const TYPE_DISABLED = 0;

    /**
     * SMPP
     * @var int
     */
    const TYPE_SMPP = 1;

    /**
     * HTTP callback
     * @var int
     */
    const TYPE_HTTP_CALLBACK = 2;

    /**
     * Email
     * @var int
     */
    const TYPE_EMAIL = 3;

    /**
     * SMSGlobal incoming report only
     * @var int
     */
    const TYPE_INBOX = 4;

    /**
     * MSISDN
     * @var string
     */
    protected $msisdn;

    /**
     * Type
     * @var int
     */
    protected $type = self::TYPE_DISABLED;

    /**
     * HTTP callback URL
     * @var string
     */
    protected $httpCallbackUrl;

    /**
     * Email address callback
     * @var string
     */
    protected $emailCallback;

    /**
     * Whether auto reply is enabled
     * @var bool
     */
    protected $isAutoReplyEnabled;

    /**
     * Auto reply message
     * @var string
     */
    protected $autoReplyMessage;

    /**
     * Auto reply origin
     * @var string
     */
    protected $autoReplyOrigin;

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
     * Sets the type
     *
     * @param int $type How to handle incoming messages. All messages still
     * appear on the SMSGlobal website regardless of this setting
     * @return $this Provides a fluent interface
     */
    public function setType($type)
    {
        $this->type = (int) $type;

        return $this;
    }

    /**
     * Gets the type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the HTTP callback URL
     *
     * @param string $httpCallbackUrl HTTP callback URL for incoming SMS
     * @return $this Provides a fluent interface
     */
    public function setHttpCallbackUrl($httpCallbackUrl)
    {
        $this->httpCallbackUrl = (string) $httpCallbackUrl;

        return $this;
    }

    /**
     * Gets the HTTP callback URL
     *
     * @return string
     */
    public function getHttpCallbackUrl()
    {
        return $this->httpCallbackUrl;
    }

    /**
     * Sets the email address callback
     *
     * @param string $emailCallback Email address to send incoming SMS to
     * @return $this Provides a fluent interface
     */
    public function setEmailCallback($emailCallback)
    {
        $this->emailCallback = (string) $emailCallback;

        return $this;
    }

    /**
     * Gets the email address callback
     *
     * @return string
     */
    public function getEmailCallback()
    {
        return $this->emailCallback;
    }

    /**
     * Sets whether auto reply is enabled
     *
     * @param bool $isAutoReplyEnabled Whether auto reply messages are enabled
     * @return $this Provides a fluent interface
     */
    public function setIsAutoReplyEnabled($isAutoReplyEnabled = true)
    {
        $this->isAutoReplyEnabled = (bool) $isAutoReplyEnabled;

        return $this;
    }

    /**
     * Gets whether auto reply is enabled
     *
     * @return bool
     */
    public function isAutoReplyEnabled()
    {
        return $this->isAutoReplyEnabled;
    }

    /**
     * Sets the auto reply message
     *
     * @param string $autoReplyMessage The auto reply message. Maximum of 480 characters
     * @return $this Provides a fluent interface
     */
    public function setAutoReplyMessage($autoReplyMessage)
    {
        $this->autoReplyMessage = (string) $autoReplyMessage;

        return $this;
    }

    /**
     * Gets the auto reply message
     *
     * @return string
     */
    public function getAutoReplyMessage()
    {
        return $this->autoReplyMessage;
    }

    /**
     * Sets the auto reply origin
     *
     * @param string $autoReplyOrigin Where the auto reply should appear to come
     * from. Blank to use the dedicated number itself. 4-15 digits or 3-11
     * numbers and letters
     * @return $this Provides a fluent interface
     */
    public function setAutoReplyOrigin($autoReplyOrigin)
    {
        $this->autoReplyOrigin = (string) $autoReplyOrigin;

        return $this;
    }

    /**
     * Gets the auto reply origin
     *
     * @return string
     */
    public function getAutoReplyOrigin()
    {
        return $this->autoReplyOrigin;
    }
}
