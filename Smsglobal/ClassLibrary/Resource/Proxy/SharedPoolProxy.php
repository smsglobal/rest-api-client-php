<?php
namespace Smsglobal\RestApiClient\Resource\Proxy;

use Smsglobal\RestApiClient\Resource\SharedPool;
use Smsglobal\RestApiClient\RestApiClient;

class SharedPoolProxy extends SharedPool
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

    public function getName()
    {
        $this->load();
        return parent::getName();
    }

    public function getSize()
    {
        $this->load();
        return parent::getSize();
    }

}
