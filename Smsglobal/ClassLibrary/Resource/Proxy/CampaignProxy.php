<?php
namespace Smsglobal\ClassLibrary\Resource\Proxy;

use Smsglobal\ClassLibrary\Resource\Campaign;
use Smsglobal\ClassLibrary\ResourceManager;

class CampaignProxy extends Campaign
{
    private $manager;

    public function __construct($resourceUri, ResourceManager $manager)
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

    public function getCustomId()
    {
        $this->load();
        return parent::getCustomId();
    }

    public function getDateTime()
    {
        $this->load();
        return parent::getDateTime();
    }

    public function getDateTimeScheduled()
    {
        $this->load();
        return parent::getDateTimeScheduled();
    }

    public function getGroup()
    {
        $this->load();
        return parent::getGroup();
    }

    public function getMessage()
    {
        $this->load();
        return parent::getMessage();
    }

    public function getName()
    {
        $this->load();
        return parent::getName();
    }

    public function getOrigin()
    {
        $this->load();
        return parent::getOrigin();
    }

    public function getStaggerBatchSize()
    {
        $this->load();
        return parent::getStaggerBatchSize();
    }

    public function getStaggerEndTime()
    {
        $this->load();
        return parent::getStaggerEndTime();
    }

    public function getStaggerGap()
    {
        $this->load();
        return parent::getStaggerGap();
    }

    public function getStaggerStartTime()
    {
        $this->load();
        return parent::getStaggerStartTime();
    }

}
