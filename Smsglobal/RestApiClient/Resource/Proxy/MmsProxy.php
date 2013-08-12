<?php
namespace Smsglobal\RestApiClient\Resource\Proxy;

use Smsglobal\RestApiClient\Resource\Mms;
use Smsglobal\RestApiClient\RestApiClient;

class MmsProxy extends Mms
{
    private $manager;

    public function __construct($resourceUri, RestApiClient $manager)
    {
        $this->resourceUri = $resourceUri;
        $this->manager = $manager;

        // Get the ID from the resource URI
        // /v1/resource/id/ -> id
        $this->id = substr($resourceUri, 0, -1);
        $this->id = (int) substr($this->id, strrpos('/', $this->id) + 1, -1);
    }

    private function load()
    {
        if (isset($this->manager)) {
            $options = $this->manager->get($this->getResourceName(), $this->id);
            $this->setOptions($options);

            unset($this->manager);
        }
    }

    public function getOrigin()
    {
        $this->load();
        return parent::getOrigin();
    }

    public function getDestination()
    {
        $this->load();
        return parent::getDestination();
    }

    public function getSubject()
    {
        $this->load();
        return parent::getSubject();
    }

    public function getMessage()
    {
        $this->load();
        return parent::getMessage();
    }

    public function getDateTimeSent()
    {
        $this->load();
        return parent::getDateTimeSent();
    }

    public function getStatus()
    {
        $this->load();
        return parent::getStatus();
    }

    public function getDateTimeStatusUpdate()
    {
        $this->load();
        return parent::getDateTimeStatusUpdate();
    }

    public function getAttachments()
    {
        $this->load();
        return parent::getAttachments();
    }

}
