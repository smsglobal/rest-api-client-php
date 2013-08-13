<?php
namespace Smsglobal\RestApiClient\Resource\Proxy;

use Smsglobal\RestApiClient\Resource\MmsIncoming;
use Smsglobal\RestApiClient\RestApiClient;

class MmsIncomingProxy extends MmsIncoming
{
    private $rest;

    public function __construct($resourceUri, RestApiClient $rest)
    {
        $this->resourceUri = $resourceUri;
        $this->rest = $rest;

        // Get the ID from the resource URI
        // /v1/resource/id/ -> id
        $this->id = substr($resourceUri, 0, -1);
        $this->id = (int) substr($this->id, strrpos('/', $this->id) + 1, -1);
    }

    private function load()
    {
        if (isset($this->rest)) {
            $options = $this->rest->get($this->getResourceName(), $this->id);
            $this->setOptions($options);

            unset($this->rest);
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

    public function getDateTimeReceived()
    {
        $this->load();
        return parent::getDateTimeReceived();
    }

    public function getAttachments()
    {
        $this->load();
        return parent::getAttachments();
    }

}
