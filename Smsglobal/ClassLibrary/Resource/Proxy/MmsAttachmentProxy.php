<?php
namespace Smsglobal\RestApiClient\Resource\Proxy;

use Smsglobal\RestApiClient\Resource\MmsAttachment;
use Smsglobal\RestApiClient\RestApiClient;

class MmsAttachmentProxy extends MmsAttachment
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

    public function getMms()
    {
        $this->load();
        return parent::getMms();
    }

    public function getName()
    {
        $this->load();
        return parent::getName();
    }

    public function getType()
    {
        $this->load();
        return parent::getType();
    }

    public function getData()
    {
        $this->load();
        return parent::getData();
    }

}
