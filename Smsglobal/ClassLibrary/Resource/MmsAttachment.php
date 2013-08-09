<?php
namespace Smsglobal\ClassLibrary\Resource;

/**
 * A resource representing an SMSGlobal MMS attachment
 *
 * @package Smsglobal\ClassLibrary\Resource
 */
class MmsAttachment extends Base
{
    /**
     * MMS
     * @var Mms
     */
    protected $mms;

    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Content type
     * @var string
     */
    protected $type;

    /**
     * File binary data
     * @var string
     */
    protected $data;

    /**
     * Gets the MMS
     *
     * @return Mms
     */
    public function getMms()
    {
        return $this->mms;
    }

    /**
     * Sets the name
     *
     * @param string $name File name of the attachment
     *
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
     * Sets the type
     *
     * @param string $type Content type of the attachment
     *
     * @return $this Provides a fluent interface
     */
    public function setType($type)
    {
        $this->type = (string) $type;

        return $this;
    }

    /**
     * Gets the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the data
     *
     * @param string $data Raw attachment data
     *
     * @return $this Provides a fluent interface
     */
    public function setData($data)
    {
        $this->data = (string) $data;

        return $this;
    }

    /**
     * Gets the data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
