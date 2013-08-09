<?php
namespace Smsglobal\ClassLibrary\Resource\Proxy;

use Smsglobal\ClassLibrary\Resource\Contact;
use Smsglobal\ClassLibrary\ResourceManager;

class ContactProxy extends Contact
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

    public function getDisplayName()
    {
        $this->load();
        return parent::getDisplayName();
    }

    public function getFamilyName()
    {
        $this->load();
        return parent::getFamilyName();
    }

    public function getGivenName()
    {
        $this->load();
        return parent::getGivenName();
    }

    public function getMsisdn()
    {
        $this->load();
        return parent::getMsisdn();
    }

    public function getEmailAddress()
    {
        $this->load();
        return parent::getEmailAddress();
    }

    public function getGroup()
    {
        $this->load();
        return parent::getGroup();
    }

}
