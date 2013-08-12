<?php
namespace Smsglobal\RestApiClient\Resource;

/**
 * A resource representing an SMSGlobal contact
 *
 * @package Smsglobal\RestApiClient\Resource
 */
class Contact extends Base
{
    /**
     * Display name
     * @var string
     */
    protected $displayName;

    /**
     * Family name
     * @var string
     */
    protected $familyName;

    /**
     * Given name
     * @var string
     */
    protected $givenName;

    /**
     * MSISDN
     * @var string
     */
    protected $msisdn;

    /**
     * Email address
     * @var string
     */
    protected $emailAddress;

    /**
     * Group
     * @var Group|int
     */
    protected $group;

    /**
     * Sets the display name
     *
     * @param string $displayName Display name or nickname. Maximum length of
     * 100 characters
     * @return $this Provides a fluent interface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = (string) $displayName;

        return $this;
    }

    /**
     * Gets the display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Sets the familyNname
     *
     * @param string $familyName Family name or surname. Maximum length of 100
     * characters
     * @return $this Provides a fluent interface
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = (string) $familyName;

        return $this;
    }

    /**
     * Gets the family name
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * Sets the given name
     *
     * @param string $givenName Given name(s). Maximum length of 100 characters
     * @return $this Provides a fluent interface
     */
    public function setGivenName($givenName)
    {
        $this->givenName = (string) $givenName;

        return $this;
    }

    /**
     * Gets the given name
     *
     * @return string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * Sets the MSISDN
     *
     * @param string $msisdn Mobile phone number including country and area
     * codes. 4 to 15 digits; no spaces or other formatting. Must be unique in
     * this group
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
     * Sets the email address
     *
     * @param string $emailAddress Email address. Must be unique in this group
     *
     * @return $this Provides a fluent interface
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = (string) $emailAddress;

        return $this;
    }

    /**
     * Gets the email address
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Sets the group
     *
     * @param int|Group $group Group or proxy instance, or ID
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
     * Gets the group
     *
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }
}
