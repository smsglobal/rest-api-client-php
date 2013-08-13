<?php
namespace Smsglobal\RestApiClient\Resource\Proxy;

use Smsglobal\RestApiClient\Resource\Group;
use Smsglobal\RestApiClient\RestApiClient;

class GroupProxy extends Group
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

    public function getName()
    {
        $this->load();
        return parent::getName();
    }

    public function getKeyword()
    {
        $this->load();
        return parent::getKeyword();
    }

    public function getDefaultOrigin()
    {
        $this->load();
        return parent::getDefaultOrigin();
    }

}
